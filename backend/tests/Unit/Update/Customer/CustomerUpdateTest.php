<?php

namespace Update\Customer;

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
        $customer = $customerFactory->create($customerData);
        $this->assertEquals(true, $customer instanceof Customer);
        $this->assertEquals($customer->getName(), $customerData['name']);


        $customerUpdateData = ["name" => 'Monika Kowalski'];
        /** @var Customer $customer */
        $customer = $customerUpdate->update($customer, $customerUpdateData);
        $this->assertEquals(true, $customer instanceof Customer);
        $this->assertEquals($customer->getName(), $customerUpdateData['name']);
        $this->assertNotEquals($customer->getName(), $customerData['name']);
    }

}