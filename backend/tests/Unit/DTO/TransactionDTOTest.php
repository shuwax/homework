<?php

use App\DTO\TransactionDTO;
use App\Entity\Customer;
use PHPUnit\Framework\TestCase;

class TransactionDTOTest extends TestCase
{
    public function testDto()
    {
        $customerObject = new Customer();
        $customerObject->setId(1);
        $transactionTDO = new TransactionDTO(120, $customerObject, '2020-01-01');
        $this->assertEquals(120, $transactionTDO->getValue());
        $this->assertEquals(1, $transactionTDO->getCustomer()->getId());
        $this->assertEquals(new DateTime('2020-01-01'), $transactionTDO->getTransactionDate());
    }
}