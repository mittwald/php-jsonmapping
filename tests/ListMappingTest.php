<?php
namespace Mw\JsonMapping\Tests;
require_once __DIR__ . '/SourceObject.php';
use Mw\JsonMapping\ListMapping;
use Mw\JsonMapping\ObjectGetterMapping;
use Mw\JsonMapping\ObjectMapping;

/**
 * Class ListMappingText
 * @package Mw\JsonMapping\Tests
 */
class ListMappingTest extends \PHPUnit_Framework_TestCase
{



    public function testListMapping()
    {
        $sourceObject = $this->prophesize('Mw\JsonMapping\Tests\SourceObject');
        $sourceObject->getUid()->willReturn(123);
        $sourceObject2 = $this->prophesize('Mw\JsonMapping\Tests\SourceObject');
        $sourceObject2->getUid()->willReturn(456);

        $sut = new ListMapping(new ObjectMapping(['uid' => new ObjectGetterMapping('getUid')]));
        $this->assertSame([['uid' => 123], ['uid' => 456]],
                          $sut->map([$sourceObject->reveal(), $sourceObject2->reveal()]));
    }

}