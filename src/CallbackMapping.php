<?php
namespace Mw\JsonMapping;


/**
 * Mapping class that simply pipes values through a callback function
 *
 * @package Mw\JsonMapping
 */
class CallbackMapping extends AbstractMapping
{

    /**
     * @var callable
     */
    private $cb;

    public function __construct(callable $cb)
    {
        $this->cb = $cb;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function map($value)
    {
        return call_user_func($this->cb, $value);
    }
}