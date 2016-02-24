<?php
namespace Mw\JsonMapping\Tests;
require_once __DIR__ . '/SourceObject.php';
use Mw\JsonMapping\BooleanMapping;

/**
 * Class BooleanMappingTest
 * @package Mw\JsonMapping\Tests
 */
class BooleanMappingTest extends \PHPUnit_Framework_TestCase
{



    public function testBooleanMapping()
    {
        $sut = new BooleanMapping();
        $this->assertSame(true, $sut->map(1));
    }

}