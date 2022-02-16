<?php

namespace Factory\Customer;

//use App\Factory\Customer\ICustomerFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CustomerFactoryTest extends KernelTestCase
{
    public function testCustomerFactory()
    {
        self::bootKernel();
        $container = static::getContainer();

//        $customerFactory = $container->get(ICustomerFactory::class);

//        $customerName = 'Jan Kowalski';
//
//        $customer = $customerFactory->create($customerName);
//
//        dump($customer);die;
//        $this->assertEquals(["message" => "alive"], $customer);
    }

}