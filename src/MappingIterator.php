<?php
namespace Mw\JsonMapping;

use Iterator;

/**
 * @package Mw\JsonMapping
 */
class MappingIterator implements \Iterator
{
    /** @var Iterator */
    private $inner;

    /** @var MappingInterface */
    private $mapping;

    public function __construct(\Iterator $inner, MappingInterface $mapping)
    {
        $this->inner   = $inner;
        $this->mapping = $mapping;
    }

    public function current()
    {
        return $this->mapping->map($this->inner->current());
    }

    public function next()
    {
        $this->inner->next();
    }

    public function key()
    {
        return $this->inner->key();
    }

    public function valid()
    {
        return $this->inner->valid();
    }

    public function rewind()
    {
        $this->inner->rewind();
    }

}
