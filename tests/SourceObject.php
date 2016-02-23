<?php
namespace Mw\JsonMapping\Tests;

/**
 * Class TestObject
 *
 * @package Mw\JsonMapping\Tests
 */
class SourceObject
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
     * @return int
     */
    public function getUid()
    {
        return $this->uid;
    }

}