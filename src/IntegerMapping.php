<?php
namespace Mw\JsonMapping;

/**
 * Class IntegerMapping
 * @package Mw\JsonMapping
 */
class IntegerMapping extends AbstractMapping
{



    /**
     * @param $value
     * @return int
     */
    public function map($value)
    {
        return intval($value);
    }

}