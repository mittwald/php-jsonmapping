# Object-to-JSON mapping framework for PHP

[![Build Status](https://travis-ci.org/mittwald/php-jsonmapping.svg?branch=master)](https://travis-ci.org/mittwald/php-jsonmapping)

This package contains a framework for mapping PHP objects into arbitrary JSON
structures.

## Installation

Install this package via Composer:

    $ composer require mittwald/php-jsonmapping

## Usage

### Mapping objects

The basic interface provided by this package is the interface
`Mw\JsonMapping\MappingInterface`. It models a basic mapping from one value to
another.

```php
interface MappingInterface
{
  public funcion map($value)
}
```

The most powerful implementation of this interface is the
`Mw\JsonMapping\ObjectMapping`. The `ObjectMapping` is used to map PHP objects
into an array structure (which can then be used for JSON serialization):

```php
$customerMapping = new ObjectMapping([
  'customerNumber' => new ObjectGetterMapping('getCustomernumber'),
  'firstName' => new ObjectGetterMapping('getFirstName')
]);
$customerJson = $customerMapping->map($customer);
```

Alternatively, use the `Mw\JsonMapping\MappingBuilder` for more concise expressions:

```php
$m = new MappingBuilder();

$customerMapping = $m->struct([
  'customerNumber' => $m->getter('getCustomernumber'),
  'firstName'      => $m->getter('getFirstName'),
]);
```

On the first glance, this code is similar to the following

```php
$customerJson = [
  'customerNumber' => $customer->getCustomernumber(),
  'firstName'      => $customer->getFirstName()
];
```

However, the `ObjectMapping` does more than simply calling getter methods and
building an array from them. The ObjectMapping also handles null objects or
getter methods not being available. So all in all, the following code is a much
better equivalent for the example:

```php
$customerJson = $customer != null ? [
  'customerNumber' => is_callable([$customer, 'getCustomernumber']) ? $customer->getCustomernumber() : null,
  'firstName' => is_callable([$customer, 'getFirstName']) ? $customer->getFirstName() : null,
] : null;
```

### Chaining mappings

Mappings can also be chained together:

```php
$customerMapping = new ObjectMapping([
  'customerNumber' => (new ObjectGetterMapping('getCustomernumber'))->then(new IntegerMapping()),
]);
```

This can also be used to map sub-objects:

```php
$customerMapping = new ObjectMapping([
  'customerNumber' => (new ObjectGetterMapping('getCustomernumber'))->then(new IntegerMapping()),
  'address'        => (new ObjectGetterMapping('getAddress'))->then(new ObjectMapping([
    'street'      => new ObjectGetterMapping('getAddress'),
    'housenumber' => new ObjectGetterMapping('getHouseNumber'),
    'country'     => new ObjectGetterMapping('getCountry')
  ]))
]);
```

Alternatively, using the `MappingBuilder`:

```php
$customerMapping = $m->struct([
  'customerNumber' => $m->getter('getCustomernumber')->then($m->toInteger()),
  'address'        => $m->getterAndStruct('getAddress', [
    'street'      => $m->getter('getAddress'),
    'housenumber' => $m->getter('getHouseNumber'),
    'country'     => $m->getter('getCountry')
  ])
]);
```

### Filtering

Object mappings can be filtered for specific properties:

```php
$customerMapping = new ObjectMapping([
  'customerNumber' => new ObjectGetterMapping('getCustomernumber'),
  'firstName'      => new ObjectGetterMapping('getFirstName')
]);

$filteredCustomerMapping = $customerMapping->filter('firstName');
```

### Merging

Also, object mappings can be merged together:

```php
$customerMapping = new ObjectMapping([
  'customerNumber' => new ObjectGetterMapping('getCustomernumber'),
  'firstName'      => new ObjectGetterMapping('getFirstName')
]);

$advancedCustomerMapping = new ObjectMapping([
  'address' => (new ObjectGetterMapping('getAddress'))->then(new ObjectMapping([
    'street'      => new ObjectGetterMapping('getAddress'),
    'housenumber' => new ObjectGetterMapping('getHouseNumber'),
    'country'     => new ObjectGetterMapping('getCountry')
  ]))
]);

$mergedCustomerMapping = $customerMapping->merge($advancedCustomerMapping);
$mergedCustomerJson = $mergedCustomerMapping->map($customer);
```

### Putting it all together

Find a complete example of all available mappings below; also, the
[examples/](examples/) folder contains more examples:.

```php
$m = new MappingBuilder();
$customerMapping = $m->struct([
  'customerNumber' => $m->getter('getCustomernumber')->then($m->toInteger()),
  'firstName'      => $m->getter('getFirstName'),
  'lastName'       => $m->getter('getLastName'),
  'invoices'       => $m->getter('getInvoices')->then($m->listing($m->struct([
    'invoiceNumber' => $m->getter('getInvoiceNumber')->then($m->toInteger()),
    'price'         => $m->getter('getPrice')->then($m->toInteger())
  ])))
]);

$addressCustomerMapping = $m->struct([
  'address' => $m->getterAndStruct('getAddress', [
    'street'      => $m->getter('getAddress'),
    'housenumber' => $m->getter('getHouseNumber'),
    'country'     => $m->getter('getCountry')
  ])
]);

$customerJson = $customerMapping
  ->merge($addressCustomerMapping)
  ->filter($userFilter)
  ->map($customer);
```
