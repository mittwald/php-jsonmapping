<?php


/**
 * Class ExampleChildObject
 */
class ExampleChildObject
{



    /**
     * @var int
     */
    protected $uid = NULL;



    /**
     * ExampleSubObject constructor.
     * @param int $uid
     */
    public function __construct($uid)
    {
        $this->uid = $uid;
    }



    /**
     * @return int
     */
    public function getUid()
    {
        return $this->uid;
    }

}

