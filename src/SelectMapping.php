<?php
namespace Mw\JsonMapping;

/**
 * Class SelectMapping
 *
 * @package Mw\JsonMapping
 */
class SelectMapping extends AbstractMapping
{
    private $filter;

    /**
     * SelectMapping constructor.
     *
     * @param array|FilterSet $filter
     */
    public function __construct($filter)
    {
        if (is_array($filter)) {
            $filter = new FilterSet(...$filter);
        }

        $this->filter = $filter;
    }

    /**
     * @param mixed $value
     * @return array
     */
    public function map($value)
    {
        if ($this->filter === NULL) {
            return $value;
        }

        $mapped = [];
        $fields = $this->filter->fields();

        foreach ($value as $key => $v) {
            if (is_array($v)) {
                $subFilter = $this->filter->subFilter($key);
                if ($subFilter) {
                    $mapped[$key] = (new SelectMapping($subFilter))->map($value[$key]);
                }
            }

            if (in_array($key, $fields)) {
                $mapped[$key] = $v;
            }
        }

        return $mapped;
    }
}