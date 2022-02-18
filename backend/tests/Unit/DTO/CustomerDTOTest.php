<?php

use App\DTO\CustomerDTO;
use PHPUnit\Framework\TestCase;

class CustomerDTOTest extends TestCase
{
    public function testDto() {
        $name = 'Jan Kowalski';
        $customerDTO = new CustomerDTO($name);
        $this->assertEquals('Jan Kowalski', $customerDTO->getName());
    }
}