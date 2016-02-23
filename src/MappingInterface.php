<?php
namespace Mw\JsonMapping;


/**
 * Interface MappingInterface
 *
 * @package Mw\JsonMapping
 */
interface MappingInterface
{



    /**
     * @param mixed $value
     * @return mixed
     */
    public function map($value);

}