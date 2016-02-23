<?php
namespace Mw\JsonMapping\Tests\Fixture;


class Invoice
{
    private $invoiceNumber;
    private $amount;

    public function __construct($invoiceNumber, $amount)
    {
        $this->invoiceNumber = $invoiceNumber;
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }


}