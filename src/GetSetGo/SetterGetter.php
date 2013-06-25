<?php namespace GetSetGo;

trait SetterGetter
{

    /**
     * Lets catch all non-existing methods and
     * process if we have 'set' or 'get' prefix
     *
     * @param  String $method [name of the calling method]
     * @param  Array  $params [Method's parameters]
     *
     * @throws \InvalidArgumentException
     * @throws SetterGetterException
     * @throws \Exception
     *
     * @return mixed
     */
    public function __call($method, $params = null)
    {
        // First 3 characters of the called method name
        $methodPrefix = strtolower(substr($method, 0, 3));
        // The rest is our property name, if method is setFoo()
        // then Foo is our property name, and will make it foo
        // (lower cased first character).
        $property = substr($method, 3);
        $property = lcfirst($property);

        // If our prefix is not 'get' or 'set', then reject it.
        if ($methodPrefix != 'get' & $methodPrefix != 'set') {
            throw new \Exception("Undefined method $method has been called!", 9);
        }

        // Read and parse annotation, if the property doesn't exist, it throw an error
        $reader = new \DocBlockReader\Reader(__CLASS__, $property, 'ReflectionProperty');

        // Get what Type user needs
        $type = $reader->getParameter('var');

        // If we have to detect generic types, then make the $type lowercase,
        // so it remains case insensitive.
        if (in_array(strtolower($type), ['string', 'number', 'array', 'object'])) {
            $type = strtolower($type);
        }

        // @getter is marked as false on property annotation
        $getter = is_null($reader->getParameter('getter')) ? true : (boolean)$reader->getParameter('getter');
        // @setter is marked as false on property annotation
        $setter = is_null($reader->getParameter('setter')) ? true : (boolean)$reader->getParameter('setter');

        if ($methodPrefix == 'set') {
            // Check if user has set @setter to false, so we won't set the value
            if (!$setter) {
                throw new SetterGetterException('Can\'t set restricted property ' . $property, 1);
                // All parameters are given
            } elseif (count($params) < 1 || !isset($params[0])) {
                throw new \InvalidArgumentException("Invalid parameter given, method <strong>$method</strong> requires 1 parameter,  but "
                . count($params) . " given!", 2);
            }

            // The value given in parameter
            $value = $params[0];

            $this->verifyCorrectType($type, $value);


            // No problem, set the property value
            $this->$property = $value;

            // Return $this, so chaining is possible on setters.
            return $this;
        } elseif ($methodPrefix == 'get') {

            // Check if user has set @getter to false, so we won't get the value
            if (!$getter) {
                throw new SetterGetterException('Can\'t get restricted property ' . $property, 8);
            }

            // No problem, get the value
            return $this->$property;
        }
    }

    /**
     * @param $type
     * @param $value
     *
     * @throws SetterGetterException
     */
    protected function verifyCorrectType($type, $value)
    {
        // Switch various types
        switch ($type) {
            case 'string':
                if (!is_string($value)) {
                    throw new SetterGetterException('String type expected', 3);
                }
                break;

            case 'number':
                if (!is_numeric($value)) {
                    throw new SetterGetterException('Number type expected', 4);
                }
                break;

            case 'array':
                if (!is_array($value)) {
                    throw new SetterGetterException('Array type expected', 5);
                }
                break;

            case 'object':
                if (!is_object($value)) {
                    throw new SetterGetterException('Object type expected.', 6);
                }
                break;

            default:
                // If a @var type is given in annotation and we haven't received
                // proper type.
                if (!is_null($type) && !$value instanceof $type) {
                    throw new SetterGetterException('Instance of ' . $type . ' expected.', 7);
                }
                break;
        }
    }
}