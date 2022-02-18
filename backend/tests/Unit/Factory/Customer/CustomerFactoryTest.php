<?php

namespace Factory\Customer;

use App\DTO\CustomerDTO;
use App\Entity\Customer;
use App\Factory\Customer\CustomerFactory;
use PHPUnit\Framework\TestCase;

class CustomerFactoryTest extends TestCase
{
    public function testCustomerFactory()
    {
        $data = ["name" => 'Jan Kowalski'];
        $customerDTO = new CustomerDTO($data["name"]);
        $factory = new CustomerFactory();

        $customer = $factory->create($customerDTO);
        $this->assertEquals(true, $customer instanceof Customer);
        $this->assertEquals($customer->getName(), $data['name']);
    }

}