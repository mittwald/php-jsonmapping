<?php
namespace Mw\JsonMapping;



/**
 * Class BooleanMapping
 *
 * @package Mw\JsonMapping
 */
class BooleanMapping extends AbstractMapping
{

    /**
     * @param $value
     * @return int
     */
    public function map($value)
    {
        return boolval($value);
    }
}