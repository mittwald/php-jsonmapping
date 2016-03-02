<?php
namespace Mw\JsonMapping;


/**
 * Helper class for quickly building new mappings
 *
 * @package Mw\JsonMapping
 */
class MappingBuilder
{
    /**
     * @return IntegerMapping
     */
    public function toInteger()
    {
        return new IntegerMapping;
    }

    /**
     * @return FloatMapping
     */
    public function toFloat()
    {
        return new FloatMapping;
    }

    /**
     * @param array $config
     * @return ObjectMapping
     */
    public function struct(array $config)
    {
        return new ObjectMapping($config);
    }

    /**
     * @param string $getter
     * @param array  $args
     * @return ObjectGetterMapping
     */
    public function getter($getter, ...$args)
    {
        return new ObjectGetterMapping($getter, ...$args);
    }

    /**
     * @param MappingInterface $inner
     * @return ListMapping
     */
    public function listing(MappingInterface $inner)
    {
        return new ListMapping($inner);
    }

    /**
     * @param string $getter
     * @param array  $config
     * @return MappingChain
     */
    public function getterAndStruct($getter, array $config)
    {
        return $this->getter($getter)->then($this->struct($config));
    }

    /**
     * @param string           $getter
     * @param MappingInterface $inner
     * @return MappingChain
     */
    public function getterAndListing($getter, MappingInterface $inner)
    {
        return $this->getter($getter)->then($this->listing($inner));
    }

    /**
     * @param callable $cb
     * @return CallbackMapping
     */
    public function callback(callable $cb)
    {
        return new CallbackMapping($cb);
    }

    /**
     * @param array|FilterSet $filter
     * @return SelectMapping
     */
    public function select($filter)
    {
        return new SelectMapping($filter);
    }
}