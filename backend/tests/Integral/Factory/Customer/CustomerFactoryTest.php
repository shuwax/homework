<?php

namespace Factory\Customer;

use App\Entity\Customer;
use App\Service\Customer\IPostCustomerService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CustomerFactoryTest extends KernelTestCase
{
    public function testCustomerFactory()
    {
        self::bootKernel();
        $container = static::getContainer();

        $customerFactory = $container->get(IPostCustomerService::class);

        $customerName = ["name" => 'Jan Kowalski'];
        /** @var Customer $customer */
        $customer = $customerFactory->create($customerName);
        $this->assertEquals($customer instanceof Customer, true);
        $this->assertEquals($customer->getName(), $customerName['name']);
    }

}