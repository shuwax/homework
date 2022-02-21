<?php

use App\DTO\TransactionUpdateDTO;
use PHPUnit\Framework\TestCase;

class TransactionUpdateDTOTest extends TestCase
{
    public function testDto()
    {
        $transactionTDO = new TransactionUpdateDTO(120, '2021-01-02');
        $this->assertEquals(120, $transactionTDO->getValue());
        $this->assertEquals(new DateTime('2021-01-02'), $transactionTDO->getTransactionDate());
    }
}