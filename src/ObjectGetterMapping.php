<?php
namespace Mw\JsonMapping;

/**
 * Class ObjectGetterMapping
 * @package Mw\JsonMapping
 */
class ObjectGetterMapping extends AbstractMapping
{



    /**
     * @var
     */
    private $getterName;



    /**
     * ObjectGetterMapping constructor.
     * @param string $getterName
     */
    public function __construct($getterName)
    {
        $this->getterName = $getterName;
    }



    /**
     * @param mixed $value
     * @return null
     */
    public function map($value)
    {
        if ($value === NULL)
        {
            return NULL;
        }

        if (is_callable(array($value, $this->getterName)))
        {
            return $value->{$this->getterName}();
        }
        return NULL;
    }
}