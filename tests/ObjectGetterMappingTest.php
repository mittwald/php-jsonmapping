<?php
namespace Mw\JsonMapping\Tests;
require_once __DIR__ . '/SourceObject.php';
use Mw\JsonMapping\ObjectGetterMapping;



/**
 * Class ObjectGetterMappingTest
 * @package Mw\JsonMapping\Tests
 */
class ObjectGetterMappingTest extends \PHPUnit_Framework_TestCase
{



    public function testNullValue()
    {
        $sourceObject = NULL;
        $sut          = new ObjectGetterMapping('getUid');
        $this->assertSame(NULL, $sut->map($sourceObject));
    }



    public function testCallableGetter()
    {
        $sourceObject = $this->prophesize('Mw\JsonMapping\Tests\SourceObject');
        $sourceObject->getUid()->willReturn(123);
        $sut = new ObjectGetterMapping('getUid');
        $this->assertSame(123, $sut->map($sourceObject->reveal()));
    }



    public function testNotCallableGetter()
    {
        $sourceObject = new SourceObject();
        $sut          = new ObjectGetterMapping('getFoo');
        $this->assertSame(NULL, $sut->map($sourceObject));
    }



    public function testGetterWithArguments()
    {
        $sourceObject = $this->prophesize('Mw\JsonMapping\Tests\SourceObject');
        $sourceObject->getUid(123)->willReturn(123);
        $sut = new ObjectGetterMapping('getUid', 123);
        $this->assertSame(123, $sut->map($sourceObject->reveal()));
    }
}