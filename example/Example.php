<?php
require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once __DIR__ . "/ExampleObject.php";
require_once __DIR__ . "/ExampleChildObject.php";

use \Mw\JsonMapping\ObjectMapping;
use \Mw\JsonMapping\ObjectGetterMapping;
use \Mw\JsonMapping\IntegerMapping;
use \Mw\JsonMapping\FloatMapping;
use \Mw\JsonMapping\ListMapping;

$exampleObject = new ExampleObject();

/**
 * Create basic ObjectMapping configuration
 */
$objectMapping = new ObjectMapping([
                                       'uid'      => new ObjectGetterMapping('getUid'),
                                       'title'    => new ObjectGetterMapping('getTitle'),
                                       'int'      => (new ObjectGetterMapping('getToInt'))->then(new IntegerMapping()),
                                       'float'    => (new ObjectGetterMapping('getToFloat'))->then(new FloatMapping()),
                                       'children' => (new ObjectGetterMapping('getChildren'))
                                           ->then(new ListMapping(new ObjectMapping([
                                                                                        'uid' => new ObjectGetterMapping('getUID')
                                                                                    ])))
                                   ]);

//var_dump($objectMapping->map($exampleObject));

/**
 * Remove a property
 */
$objectMapping->remove('int');

//var_dump($objectMapping->map($exampleObject));

/**
 * Create merged ObjectMapping configuration
 */
$mergedObjectMapping = $objectMapping->merge(new ObjectMapping([
                                                                   'toInt'   => new ObjectGetterMapping('getToInt'),
                                                                   'toFloat' => new ObjectGetterMapping('getToFloat')
                                                               ]));

//var_dump($objectMapping->map($exampleObject));

/**
 * Create filtered ObjectMapping configuration
 */
$filteredObjectMapping = $objectMapping->filter(['uid', 'children']);

//var_dump($filteredObjectMapping->map($exampleObject));