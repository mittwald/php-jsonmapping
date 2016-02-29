<?php
namespace Mw\JsonMapping\Tests;

use Mw\JsonMapping\BooleanMapping;
use Mw\JsonMapping\CallbackMapping;

/**
 * Class BooleanMappingTest
 * @package Mw\JsonMapping\Tests
 */
class CallbackMappingTest extends \PHPUnit_Framework_TestCase
{



    public function testBooleanMapping()
    {
        $inc = new CallbackMapping(function($v) {
            return $v+1;
        });

        assertThat($inc->map(5), equalTo(6));
    }

}