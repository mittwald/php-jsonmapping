<?php
namespace Mw\JsonMapping\Tests;

use Mw\JsonMapping\MappingBuilder;
use Mw\JsonMapping\Tests\Fixture\Customer;
use Mw\JsonMapping\Tests\Fixture\Invoice;

class MappingBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testMappingIsBuiltCorrectly()
    {
        $customer = new Customer(
            '1234',
            'John',
            'Doe',
            [
                new Invoice(1000, "123.99"),
                new Invoice(1001, "321.99"),
            ]
        );

        $m = new MappingBuilder();
        $mapping = $m->struct([
            'uid'       => $m->getter('getCustomernumber')->then($m->toInteger()),
            'firstName' => $m->getter('getFirstName'),
            'lastName'  => $m->getter('getLastName'),
            'invoices'  => $m->getterAndListing('getInvoices', $m->struct([
                'uid'    => $m->getter('getInvoiceNumber')->then($m->toInteger()),
                'amount' => $m->getter('getAmount')->then($m->toFloat())
            ]))
        ]);

        assertThat($mapping->map($customer), identicalTo([
            'uid' => 1234,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'invoices' => [
                ['uid' => 1000, 'amount' => 123.99],
                ['uid' => 1001, 'amount' => 321.99],
            ]
        ]));
    }
}