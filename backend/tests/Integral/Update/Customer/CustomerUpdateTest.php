<?php

namespace Update\Customer;

use App\Entity\Customer;
use App\Factory\Customer\ICustomerFactory;
use App\Update\Customer\ICustomerUpdate;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CustomerUpdateTest extends KernelTestCase
{
    public function testCustomerFactory()
    {
        self::bootKernel();
        $container = static::getContainer();

        $customerFactoryService = $container->get(ICustomerFactory::class);

        $customerUpdateService = $container->get(ICustomerUpdate::class);

        $customerName = ["name" => 'Jan Kowalski'];
        /** @var Customer $customer */
        $customer = $customerFactoryService->create($customerName['name']);
        $this->assertEquals(true, $customer instanceof Customer);
        $this->assertEquals($customer->getName(), $customerName['name']);


        $customerUpdate = ["name" => 'Monika Kowalski'];
        /** @var Customer $customer */
        $customer = $customerUpdateService->update($customer, $customerUpdate['name']);
        $this->assertEquals(true, $customer instanceof Customer);
        $this->assertEquals($customer->getName(), $customerUpdate['name']);
        $this->assertNotEquals($customer->getName(), $customerName['name']);
    }

}