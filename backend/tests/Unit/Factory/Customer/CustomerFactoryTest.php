<?php

namespace Factory\Customer;

use App\Entity\Customer;
use App\Factory\Customer\CustomerFactory;
use PHPUnit\Framework\TestCase;

class CustomerFactoryTest extends TestCase
{
    public function testCustomerFactory()
    {
        $data = ["name" => 'Jan Kowalski'];

        $factory = new CustomerFactory();

        $customer = $factory->create($data);
        $this->assertEquals(true, $customer instanceof Customer);
        $this->assertEquals($customer->getName(), $data['name']);
    }

}