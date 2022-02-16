<?php

namespace Service\Customer;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostCustomerServiceTest extends KernelTestCase
{
    public function testGetAliveService()
    {
        self::bootKernel();
        $container = static::getContainer();

        $postService = $container->get(IPostService::class);

        $customer = [
            'name' => 'Jan Kowalski'
        ];

        $this->assertEquals(["message" => "alive"], $postService->create($customer));
    }

}