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
    public function __construct(...$innerMappings)
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

        foreach ($this->innerMappings as $mapping)
        {
            $newMapped = $mapping->map($value);
            $mapped    = array_replace_recursive($mapped, $newMapped);
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
        foreach ($this->innerMappings as $innerMapping)
        {
            $newInnerMappings[] = $innerMapping->filter($fieldNames);
        }
        return new MergeMapping(...$newInnerMappings);
    }



    /**
     * @param string $key
     */
    public function remove($key)
    {
        foreach ($this->innerMappings as $innerMapping)
        {
            $innerMapping->remove($key);
        }
    }



    /**
     * @param ObjectMapping $merge
     * @return MergeMapping
     */
    public function merge(ObjectMapping $merge)
    {
        $objectMappings = $this->innerMappings;
        $objectMappings[] = $merge;
        return new MergeMapping(...$objectMappings);
    }
}


