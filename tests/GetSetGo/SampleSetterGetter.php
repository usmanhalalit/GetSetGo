<?php namespace GetSetGo;

class SampleSetterGetter
{
    use \GetSetGo\SetterGetter;

    protected $plainVar;

    /**
     * Should be an instance of stdClass only.
     *
     * @var \stdClass
     */
    protected $shouldBeStdClass;

    /**
     * Should be an array only.
     *
     * @var Array
     */
    protected $shouldBeArray;

    /**
     * Should be a string only
     *
     * @var String
     */
    protected $shouldBeString;

    /**
     * Should be a number only.
     *
     * @var Number
     */
    protected $shouldBeNumber;

    /**
     * Should be an array only.
     *
     * @var Object
     */
    protected $shouldBeObject;

    /**
     * We can't use setSetterFalse('anything') anymore.
     *
     * @var
     * @setter false
     */
    protected $setterFalse;

    /**
     * We can't use getGetterFalse() anymore.
     *
     * @var \stdClass
     * @getter false
     */
    protected $getterFalse;

    /**
     * We can't use setBothFalse('anything') or getBothFalse().
     *
     * @getter false
     * @setter false
     */
    protected $bothFalse;

    public function setGeneralValue()
    {
        return true;
    }

    public function getGeneralValue()
    {
        return true;
    }
}