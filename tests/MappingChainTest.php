<?php
namespace Mw\JsonMapping\Tests;
require_once __DIR__ . '/SourceObject.php';
use Mw\JsonMapping\MappingChain;

/**
 * Class ListMappingText
 * @package Mw\JsonMapping\Tests
 */
class MappingChainTest extends \PHPUnit_Framework_TestCase
{



    public function testMap()
    {
        $sourceObject = new SourceObject();
        $objectMapping = $this->prophesize('Mw\JsonMapping\ObjectMapping');
        $objectMapping->map($sourceObject)->shouldBeCalled()->willReturnArgument(0);
        $sut = new MappingChain($objectMapping->reveal(), $objectMapping->reveal());
        $sut->map($sourceObject);
    }

}

