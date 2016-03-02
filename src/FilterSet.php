<?php
namespace Mw\JsonMapping;


/**
 * Class FilterSet
 *
 * @package Mw\JsonMapping
 */
class FilterSet
{
    private $fields     = [];

    private $subFilters = [];

    /**
     * FilterSet constructor.
     *
     * @param array ...$fields
     */
    public function __construct(...$fields)
    {
        $subFilters = [];

        foreach ($fields as $field) {
            $components = explode('.', $field);
            if (count($components) === 1) {
                $this->fields[$field] = TRUE;
            } else {
                $subFilterName = array_shift($components);
                if (!isset($subFilters[$subFilterName])) {
                    $subFilters[$subFilterName] = [];
                }
                $subFilters[$subFilterName][] = implode('.', $components);
            }
        }

        foreach ($subFilters as $name => $subFields) {
            $this->fields[$name] = TRUE;
            $this->subFilters[$name] = new FilterSet(...$subFields);
        }
    }

    /**
     * @param array ...$fields
     * @return FilterSet
     */
    public function orDefault(...$fields)
    {
        if (count($this->fields) === 0) {
            return new static(...$fields);
        } else {
            return $this;
        }
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return (count($this->fields) == 0) && (count($this->subFilters) == 0);
    }

    /**
     * @return array
     */
    public function fields()
    {
        return array_keys($this->fields);
    }

    /**
     * @param $path
     * @return FilterSet
     */
    public function subFilter($path)
    {
        if (!$path) {
            return $this;
        }

        $components = explode('.', $path, 2);
        if (isset($this->subFilters[$components[0]])) {
            return $this->subFilters[$components[0]]->subFilter($components[1]);
        }
        return NULL;
    }
}