<?php
namespace Mw\JsonMapping;

/**
 * Class ObjectMapping
 *
 * @package Mw\JsonMapping
 */
class ObjectMapping extends AbstractMapping
{

    /** @var array */
    private $config;

    /**
     * ObjectMapping constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param mixed $value
     * @return array|null
     */
    public function map($value)
    {
        if ($value === NULL) {
            return NULL;
        }

        $result = [];

        foreach ($this->config as $key => $subMapping) {
            $mapped = $subMapping;
            if ($mapped instanceof MappingInterface) {
                $mapped = $mapped->map($value);
            } else if (is_callable($subMapping)) {
                $mapped = $subMapping($value);
            } else if (is_array($subMapping)) {
                $subMapping = new static($subMapping);
                $mapped = $subMapping->map($value);
            }
            $result[$key] = $mapped;
        }

        return $result;
    }

    /**
     * @param string $key
     */
    public function remove($key)
    {
        unset($this->config[$key]);
    }

    /**
     * @param array $fieldNames
     * @return ObjectMapping
     */
    public function filter(array $fieldNames)
    {
        $newMapping = [];

        foreach ($fieldNames as $fieldName) {
            if (isset($this->config[$fieldName])) {
                $newMapping[$fieldName] = $this->config[$fieldName];
            }
        }

        return new ObjectMapping($newMapping);
    }

    /**
     * @param ObjectMapping $merge
     * @return MergeMapping
     */
    public function merge(ObjectMapping $merge)
    {
        return new MergeMapping($this, $merge);
    }
}