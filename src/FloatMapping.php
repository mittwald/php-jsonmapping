<?php
namespace Mw\JsonMapping;

/**
 * Class FloatMapping
 *
 * @package Mw\JsonMapping
 */
class FloatMapping extends AbstractMapping
{

    /**
     * @param $value
     * @return float
     */
    public function map($value)
    {
        return floatval($value);
    }
}