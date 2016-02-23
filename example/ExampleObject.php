<?php


/**
 * Class ExampleObject
 */
class ExampleObject
{



    /**
     * @var int
     */
    protected $uid = 123;


    /**
     * @var string
     */
    protected $title = "Example Object";


    /**
     * @var string
     */
    protected $toInt = "456";


    /**
     * @var string
     */
    protected $toFloat = "7.89";


    /**
     * @var ExampleChildObject[]
     */
    protected $children = [];



    /**
     * ExampleObject constructor.
     */
    public function __construct()
    {
        $this->children = [new ExampleChildObject(1), new ExampleChildObject(2)];
    }



    /**
     * @return int
     */
    public function getUid()
    {
        return $this->uid;
    }



    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }



    /**
     * @return string
     */
    public function getToInt()
    {
        return $this->toInt;
    }



    /**
     * @return string
     */
    public function getToFloat()
    {
        return $this->toFloat;
    }



    /**
     * @return ExampleChildObject[]
     */
    public function getChildren()
    {
        return $this->children;
    }

}