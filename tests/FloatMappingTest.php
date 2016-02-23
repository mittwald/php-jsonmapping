<?php
namespace Mw\JsonMapping\Tests;
require_once __DIR__ . '/SourceObject.php';
use Mw\JsonMapping\FloatMapping;

/**
 * Class FloatMappingTest
 * @package Mw\JsonMapping\Tests
 */
class FloatMappingTest extends \PHPUnit_Framework_TestCase
{



    public function testFloatMapping()
    {
        $sut = new FloatMapping();
        $this->assertSame(123.456, $sut->map("123.456"));
    }

}