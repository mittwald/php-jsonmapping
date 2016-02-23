<?php
namespace Mw\JsonMapping;

/**
 * Class ListMapping
 *
 * @package Mw\JsonMapping
 */
class ListMapping extends AbstractMapping
{

    /**
     * @var MappingInterface
     */
    private $innerMapping;

    /**
     * ListMapping constructor.
     *
     * @param MappingInterface $innerMapping
     */
    public function __construct(MappingInterface $innerMapping)
    {
        $this->innerMapping = $innerMapping;
    }

    /**
     * @param $value
     * @return array
     */
    public function map($value)
    {
        return array_map([$this->innerMapping, 'map'], $value);
    }
}