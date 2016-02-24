<?php
namespace Mw\JsonMapping;

/**
 * Class ObjectGetterMapping
 *
 * @package Mw\JsonMapping
 */
class ObjectGetterMapping extends AbstractMapping
{



    /** @var string */
    private $getterName;


    /** @var array */
    private $getterArgs;



    /**
     * ObjectGetterMapping constructor.
     *
     * @param string $getterName
     * @param array  $getterArgs
     */
    public function __construct($getterName, ...$getterArgs)
    {
        $this->getterName = $getterName;
        $this->getterArgs = $getterArgs;
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
            return $value->{$this->getterName}(...$this->getterArgs);
        }

        return NULL;
    }
}