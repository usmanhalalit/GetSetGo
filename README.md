# GetSetGo [![Build Status](https://travis-ci.org/usmanhalalit/GetSetGo.png?branch=master)](https://travis-ci.org/usmanhalalit/GetSetGo)
A dynamic getter-setter library for PHP 5.4+.

You can use methods like `setFoo('bar')` and `getFoo()`, which you DON'T have to create (in your class). GetSetGo will make these methods work for you automatically as long as you have a `$foo` property in your class. 

It makes use of Traits, so `using` it is super simple. You can restrict to only getter only or you can specify a Type for property using annotations.

## Installation

GetSetGo uses Composer to make hassles Go.

Learn to use composer and add this to require (in your composer.json):

    "usmanhalalit/get-set-go": "dev-master"

## Usage

Just add this in your classes:

    use \GetSetGo\SetterGetter;

Example:

    Class MyClass{
        use \GetSetGo\SetterGetter;
    	
		property $foo;
    }
Now use it as
	$myClass = new MyClass;
	
	$myClass->setFoo('bar');
	echo $myClass->getFoo();


**That's it.**

### Restrict Getter or Setter or Both

You can use annotation in you class property if you want to disbale setter, getter or both.

	/**
	 * We can't use setSomeProperty() anymore.
	 *
	 * @var
	 * @setter false
	 */
	protected $someProperty;

___

	/**
	 * We can't use getSomeProperty() anymore.
	 *
	 * @var \stdClass
	 * @getter false
	 */
	protected $someProperty;

___


	/**
	 * We can't use setSomeProperty() or getSomeProperty().
	 *
	 * @getter false
	 * @setter false
	 */
	protected $someProperty;


### Force a Type or Class


    /**
     * Should be an instance of stdClass only.
     *
     * @var \stdClass
     */
    protected $shouldBeStdClass;

___

    /**
     * Should be an array only.
     *
     * @var Array
     */
    protected $shouldBeArray;

___

    /**
     * Should be a string only
     *
     * @var String
     */
    protected $shouldBeString;

___

    /**
     * Should be a number only.
     *
     * @var Number
     */
    protected $shouldBeNumber;

___

    /**
     * Should be an array only.
     *
     * @var Object
     */
    protected $shouldBeObject;
