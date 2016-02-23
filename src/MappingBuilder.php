<?php
namespace Mw\JsonMapping;


class MappingBuilder
{
    public function toInteger()
    {
        return new IntegerMapping;
    }

    public function toFloat()
    {
        return new FloatMapping;
    }

    public function struct(array $config)
    {
        return new ObjectMapping($config);
    }

    public function getter($getter)
    {
        return new ObjectGetterMapping($getter);
    }

    public function listing(MappingInterface $inner)
    {
        return new ListMapping($inner);
    }

    public function getterAndStruct($getter, $config)
    {
        return $this->getter($getter)->then($this->struct($config));
    }

    public function getterAndListing($getter, MappingInterface $inner)
    {
        return $this->getter($getter)->then($this->listing($inner));
    }
}