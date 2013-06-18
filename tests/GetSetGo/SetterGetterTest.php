<?php namespace GetSetGo;

class SetterGetterTest extends \PHPUnit_Framework_TestCase
{
    protected static $sampleClass;

    public static function setupBeforeClass()
    {
        require 'SampleSetterGetter.php';
        static::$sampleClass = new SampleSetterGetter();
    }

    public function testPlainSetter()
    {
        static::$sampleClass->setPlainVar('plain var');
        $this->assertEquals(static::$sampleClass->getPlainVar(), 'plain var');
    }

    /**
     * @expectedException \GetSetGo\SetterGetterException
     * @expectedExceptionCode 3
     */
    public function testStringExpectedSetterWithNumber()
    {
        static::$sampleClass->setShouldBeString(1);
    }

    public function testStringExpectedSetterWithString()
    {
        static::$sampleClass->setShouldBeString('value');
        $this->assertEquals('value', static::$sampleClass->getShouldBeString());
    }

    /**
     * @expectedException \GetSetGo\SetterGetterException
     * @expectedExceptionCode 4
     */
    public function testNumberExpectedSetterWithString()
    {
        static::$sampleClass->setShouldBeNumber('value');
    }

    public function testNumberExpectedSetterWithNumber()
    {
        static::$sampleClass->setShouldBeNumber(0);
        $this->assertEquals(0, static::$sampleClass->getShouldBeNumber());
    }

    /**
     * @expectedException \GetSetGo\SetterGetterException
     * @expectedExceptionCode 5
     */
    public function testArrayExpectedSetterWithString()
    {
        static::$sampleClass->setShouldBeArray('value');
    }

    public function testArrayExpectedSetterWithArray()
    {
        static::$sampleClass->setShouldBeArray(['value']);
        $this->assertEquals(['value'], static::$sampleClass->getShouldBeArray());
    }

    /**
     * @expectedException \GetSetGo\SetterGetterException
     * @expectedExceptionCode 6
     */
    public function testObjectExpectedSetterWithString()
    {
        static::$sampleClass->setShouldBeObject('value');
    }

    public function testObjectExpectedSetterWithObject()
    {
        static::$sampleClass->setShouldBeObject((object)['value']);
        $this->assertEquals((object)['value'], static::$sampleClass->getShouldBeObject());
    }

    /**
     * @expectedException \GetSetGo\SetterGetterException
     * @expectedExceptionCode 7
     */
    public function testStdClassExpectedSetterWithString()
    {
        static::$sampleClass->setShouldBeStdClass('plain var');
    }

    public function testStdClassExpectedSetterWithStdClass()
    {
        $stdClass = new \stdClass();
        static::$sampleClass->setShouldBeStdClass($stdClass);
        $this->assertInstanceOf('\stdClass', static::$sampleClass->getShouldBeStdClass());
    }

    /**
     * @expectedException \GetSetGo\SetterGetterException
     * @expectedExceptionCode 1
     */
    public function testSetterFalse()
    {
        static::$sampleClass->setSetterFalse('value');
    }

    /**
     * @expectedException \GetSetGo\SetterGetterException
     * @expectedExceptionCode 8
     */
    public function testGetterFalse()
    {
        static::$sampleClass->getGetterFalse();
    }

    /**
     * @expectedException \GetSetGo\SetterGetterException
     * @expectedExceptionCode 1
     */
    public function testSetBothFalse()
    {
        static::$sampleClass->setBothFalse('value');
    }

    /**
     * @expectedException \GetSetGo\SetterGetterException
     * @expectedExceptionCode 8
     */
    public function testGetBothFalse()
    {
        static::$sampleClass->getBothFalse();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionCode 2
     */
    public function testInvalidSetterWithEmptyArgument()
    {
        static::$sampleClass->setPlainVar();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionCode 9
     */
    public function testNonExistingMethod()
    {
        static::$sampleClass->itDoesNotExist();
    }

    public function testIfExistingSetPrefixAndGetPrefixMethodsWork()
    {
        $this->assertTrue(static::$sampleClass->setGeneralValue());
        $this->assertTrue(static::$sampleClass->getGeneralValue());
    }

    /**
     * @expectedException \ReflectionException
     */
    public function testNonExistingProperty()
    {
        static::$sampleClass->setNonExistingMethod();
    }
}