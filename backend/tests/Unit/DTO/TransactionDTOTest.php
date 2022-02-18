<?php

use App\DTO\TransactionDTO;
use PHPUnit\Framework\TestCase;

class TransactionDTOTest extends TestCase
{
    public function testDto()
    {
        $transactionTDO = new TransactionDTO(120, 1);
        $this->assertEquals(120, $transactionTDO->getValue());
        $this->assertEquals(1, $transactionTDO->getCustomerId());
        $this->assertEquals(null, $transactionTDO->getCustomer());
    }
}