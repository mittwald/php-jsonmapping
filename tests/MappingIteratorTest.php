<?php

namespace Mw\JsonMapping\Tests;

use Mw\JsonMapping\CallbackMapping;
use Mw\JsonMapping\MappingIterator;

class MappingIteratorTest extends \PHPUnit_Framework_TestCase
{
    public function testMappingIterator()
    {
        $mapping  = new CallbackMapping(function ($a) {
            return strtoupper($a);
        });
        $source   = new \ArrayIterator(["foo", "bar"]);
        $iterator = new MappingIterator($source, $mapping);

        $result = iterator_to_array($iterator);

        assertThat($result, identicalTo(["FOO", "BAR"]));
    }
}
