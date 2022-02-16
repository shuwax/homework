<?php

namespace Service\Customer;

use App\Entity\Customer;
use App\Service\Customer\IPostCustomerService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostCustomerServiceTest extends KernelTestCase
{
    public function testGetAliveService()
    {
        self::bootKernel();
        $container = static::getContainer();

        $postService = $container->get(IPostCustomerService::class);

        $customer = [
            'name' => 'Jan Kowalski'
        ];

        $serviceResult = $postService->create($customer);

        $this->assertEquals($serviceResult instanceof Customer, true);
        $this->assertEquals($serviceResult->getName(), $customer['name']);
    }

}