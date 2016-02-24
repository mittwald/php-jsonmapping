<?php
/**
 * Created by PhpStorm.
 * User: sgieselmann
 * Date: 24.02.16
 * Time: 10:55
 */

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