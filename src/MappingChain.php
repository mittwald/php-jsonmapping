<?php
namespace Mw\JsonMapping;

/**
 * Class MappingChain
 *
 * @package Mw\JsonMapping
 */
class MappingChain extends AbstractMapping
{

    /**
     * @var array
     */
    private $nested;

    /**
     * MappingChain constructor.
     *
     * @param MappingInterface[] ...$nested
     */
    public function __construct(...$nested)
    {
        $this->nested = $nested;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function map($value)
    {
        foreach ($this->nested as $nested) {
            $value = $nested->map($value);
        }
        return $value;
    }
}