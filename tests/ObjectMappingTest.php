<?php
namespace Mw\JsonMapping\Tests;
require_once __DIR__ . '/SourceObject.php';
use Mw\JsonMapping\ObjectMapping;

/**
 * Class ObjectMappingTest
 * @package Mw\JsonMapping\Tests
 */
class ObjectMappingTest extends \PHPUnit_Framework_TestCase
{



    /**
     * @var ObjectMapping
     */
    protected $sut;



    public function testNullValue()
    {
        $sourceObject = NULL;
        $sut          = new ObjectMapping(['staticValue' => 'fooBar']);
        $this->assertSame(NULL, $sut->map($sourceObject));
    }



    public function testStaticConfigurationValue()
    {
        $sourceObject = $this->prophesize('Mw\JsonMapping\Tests\SourceObject');
        $sut          = new ObjectMapping(['staticValue' => 'fooBar']);
        $this->assertSame(['staticValue' => 'fooBar'], $sut->map($sourceObject));
    }



    public function testStaticArrayConfigurationValue()
    {
        $sourceObject = $this->prophesize('Mw\JsonMapping\Tests\SourceObject');
        $sut          = new ObjectMapping(['arrayValue' => ['staticValue' => 'fooBar']]);
        $this->assertSame(['arrayValue' => ['staticValue' => 'fooBar']], $sut->map($sourceObject));
    }



    public function testCallableConfigurationValue()
    {
        $sourceObject = $this->prophesize('Mw\JsonMapping\Tests\SourceObject');
        $sourceObject->getUid()->willReturn(123);
        $sut = new ObjectMapping(['callbackValue' => function (SourceObject $sourceObject) { return $sourceObject->getUid(); }]);
        $this->assertSame(['callbackValue' => 123], $sut->map($sourceObject->reveal()));
    }



    public function testNestedMappingConfigurationValue()
    {
        $sourceObject = $this->prophesize('Mw\JsonMapping\Tests\SourceObject');
        $sourceObject->getUid()->willReturn(123);
        $nestedObjectMapping = $this->prophesize('Mw\JsonMapping\ObjectMapping');
        $nestedObjectMapping->map($sourceObject)->shouldBeCalled();
        $sut = new ObjectMapping(['callbackValue' => $nestedObjectMapping->reveal()]);
        $sut->map($sourceObject->reveal());
    }



    public function testFilter()
    {
        $sourceObject = $this->prophesize('Mw\JsonMapping\Tests\SourceObject');
        $sut          = new ObjectMapping([
                                              'staticValue' => 'foo',
                                              'toFilter'    => 'bar'
                                          ]);
        $filteredSut  = $sut->filter(['toFilter']);
        $this->assertSame(['toFilter' => 'bar'], $filteredSut->map($sourceObject));
    }



    public function testRemove()
    {
        $sourceObject = $this->prophesize('Mw\JsonMapping\Tests\SourceObject');
        $sut          = new ObjectMapping([
                                              'notDelete' => 'foo',
                                              'delete'    => 'bar'
                                          ]);
        $sut->remove('delete');
        $this->assertSame([
                              'notDelete' => 'foo'
                          ], $sut->map($sourceObject));
    }



    public function testMerge()
    {
        $sourceObject = $this->prophesize('Mw\JsonMapping\Tests\SourceObject');
        $sut          = new ObjectMapping([
                                              'exist1' => 'foo',
                                              'exist2' => 'bar'
                                          ]);
        $mergedSut    = $sut->merge(new ObjectMapping([
                                                          'newProperty' => 'new',
                                                          'exist2'      => 'overwrite'
                                                      ]));
        $this->assertSame([
                              'exist1'      => 'foo',
                              'exist2'      => 'overwrite',
                              'newProperty' => 'new'
                          ], $mergedSut->map($sourceObject));
    }
}