<?php

use App\DTO\TransactionDTO;
use PHPUnit\Framework\TestCase;

class TransactionDTOTest extends TestCase
{
    public function testDto()
    {
        $transactionTDO = new TransactionDTO(120, 1, '2020-01-01');
        $this->assertEquals(120, $transactionTDO->getValue());
        $this->assertEquals(1, $transactionTDO->getCustomerId());
        $this->assertEquals(null, $transactionTDO->getCustomer());
        $this->assertEquals(new DateTime('2020-01-01'), $transactionTDO->getTransactionDate());
    }
}