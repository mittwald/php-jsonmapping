<?php
namespace Mw\JsonMapping;

class MergeMapping extends ObjectMapping
{

    /**
     * @var ObjectMapping[]
     */
    private $innerMappings;

    /**
     * MergeMapping constructor.
     *
     * @param ObjectMapping[] ...$innerMappings
     */
    public function __construct(ObjectMapping ...$innerMappings)
    {
        $this->innerMappings = $innerMappings;
    }

    /**
     * @param mixed $value
     * @return array
     */
    public function map($value)
    {
        $mapped = [];

        foreach ($this->innerMappings as $mapping) {
            $newMapped = $mapping->map($value);
            $mapped = array_replace_recursive($mapped, $newMapped);
        }

        return $mapped;
    }

    /**
     * @param array $fieldNames
     * @return MergeMapping
     */
    public function filter(array $fieldNames)
    {
        $newInnerMappings = [];
        foreach ($this->innerMappings as $innerMapping) {
            $newInnerMappings[] = $innerMapping->filter($fieldNames);
        }
        return new MergeMapping(...$newInnerMappings);
    }
}


