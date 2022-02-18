<?php

namespace Update\Customer;

use App\DTO\CustomerDTO;
use App\Entity\Customer;
use App\Factory\Customer\CustomerFactory;
use App\Update\Customer\CustomerUpdate;
use PHPUnit\Framework\TestCase;

class CustomerUpdateTest extends TestCase
{
    public function testCustomerFactory()
    {

        $customerFactory = new CustomerFactory();
        $customerUpdate = new CustomerUpdate();

        $customerData = ["name" => 'Jan Kowalski'];
        $customerDTO = new CustomerDTO($customerData['name']);

        $customer = $customerFactory->create($customerDTO);
        $this->assertEquals(true, $customer instanceof Customer);
        $this->assertEquals($customer->getName(), $customerData['name']);


        $customerUpdateData = ["name" => 'Monika Kowalski'];
        $customerDTO = new CustomerDTO($customerUpdateData['name']);
        /** @var Customer $customer */
        $customer = $customerUpdate->update($customer, $customerDTO);
        $this->assertEquals(true, $customer instanceof Customer);
        $this->assertEquals($customer->getName(), $customerUpdateData['name']);
        $this->assertNotEquals($customer->getName(), $customerData['name']);
    }

}