<?php

namespace Factory\Customer;

use App\Entity\Customer;
use App\Factory\Customer\ICustomerFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CustomerFactoryTest extends KernelTestCase
{
    public function testCustomerFactory()
    {
        self::bootKernel();
        $container = static::getContainer();

        $customerFactory = $container->get(ICustomerFactory::class);

        $customerName = ["name" => 'Jan Kowalski'];
        /** @var Customer $customer */
        $customer = $customerFactory->create($customerName['name']);
        $this->assertEquals(true, $customer instanceof Customer);
        $this->assertEquals($customer->getName(), $customerName['name']);
    }

}