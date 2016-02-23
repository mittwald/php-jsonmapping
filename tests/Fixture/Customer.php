<?php
namespace Mw\JsonMapping\Tests\Fixture;


class Customer
{
    private $customerNumber;
    private $firstName;
    private $lastName;
    /**
     * @var array
     */
    private $invoices;

    public function __construct($customerNumber, $firstName, $lastName, array $invoices)
    {
        $this->customerNumber = $customerNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->invoices = $invoices;
    }

    /**
     * @return mixed
     */
    public function getCustomerNumber()
    {
        return $this->customerNumber;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return array
     */
    public function getInvoices()
    {
        return $this->invoices;
    }


}