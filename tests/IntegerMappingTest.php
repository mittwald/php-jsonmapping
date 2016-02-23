<?php
namespace Mw\JsonMapping\Tests;
require_once __DIR__ . '/SourceObject.php';
use Mw\JsonMapping\IntegerMapping;

/**
 * Class IntegerMappingTest
 * @package Mw\JsonMapping\Tests
 */
class IntegerMappingTest extends \PHPUnit_Framework_TestCase
{



    public function testIntegerMapping()
    {
        $sut = new IntegerMapping();
        $this->assertSame(123, $sut->map("123.5"));
    }

}