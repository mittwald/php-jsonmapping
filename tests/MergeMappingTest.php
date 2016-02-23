<?php
namespace Mw\JsonMapping\Tests;
require_once __DIR__ . '/SourceObject.php';
use Mw\JsonMapping\MergeMapping;
use Mw\JsonMapping\ObjectMapping;

/**
 * Class MergeMappingTest
 * @package Mw\JsonMapping\Tests
 */
class MergeMappingTest extends \PHPUnit_Framework_TestCase
{



    public function testMerge()
    {
        $sourceObject  = new SourceObject();
        $objectMapping = $this->prophesize('Mw\JsonMapping\ObjectMapping');
        $objectMapping->map($sourceObject)->shouldBeCalled()->willReturn([1]);
        $objectMapping2 = $this->prophesize('Mw\JsonMapping\ObjectMapping');
        $objectMapping2->map($sourceObject)->shouldBeCalled()->willReturn([2]);
        $sut = new MergeMapping($objectMapping->reveal(), $objectMapping2->reveal());
        $this->assertSame([2], $sut->map($sourceObject));
    }



    public function testFilter()
    {
        $filterArray   = ['foo', 'bar'];
        $objectMapping = $this->prophesize('Mw\JsonMapping\ObjectMapping');
        $objectMapping->filter($filterArray)->shouldBeCalled()->willReturn(new ObjectMapping(['static' => 'value']));
        $objectMapping2 = $this->prophesize('Mw\JsonMapping\ObjectMapping');
        $objectMapping2->filter($filterArray)->shouldBeCalled()->willReturn(new ObjectMapping(['static' => 'value']));
        $sut = new MergeMapping($objectMapping->reveal(), $objectMapping2->reveal());
        $sut->filter($filterArray);
    }
}