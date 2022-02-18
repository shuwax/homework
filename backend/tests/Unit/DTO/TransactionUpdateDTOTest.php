<?php

use App\DTO\TransactionUpdateDTO;
use PHPUnit\Framework\TestCase;

class TransactionUpdateDTOTest extends TestCase
{
    public function testDto()
    {
        $transactionTDO = new TransactionUpdateDTO(120);
        $this->assertEquals(120, $transactionTDO->getValue());
    }
}