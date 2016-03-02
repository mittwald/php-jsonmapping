<?php
namespace Mw\JsonMapping;

class MergeMapping extends ObjectMapping
{



    /**
     * @var MappingInterface[]
     */
    private $innerMappings;



    /**
     * MergeMapping constructor.
     *
     * @param MappingInterface[] ...$innerMappings
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
     * @param array|FilterSet $filter
     * @return MergeMapping
     */
    public function filter($filter)
    {
        $newInnerMappings = [];
        foreach ($this->innerMappings as $innerMapping)
        {
            $newInnerMappings[] = $innerMapping->filter($filter);
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
     * @param MappingInterface $merge
     * @return MergeMapping
     */
    public function merge(MappingInterface $merge)
    {
        $objectMappings = $this->innerMappings;
        $objectMappings[] = $merge;
        return new MergeMapping(...$objectMappings);
    }
}


