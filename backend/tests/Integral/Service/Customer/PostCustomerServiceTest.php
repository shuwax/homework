<?php

namespace Service\Customer;

use App\DTO\CustomerDTO;
use App\Entity\Customer;
use App\Service\Customer\IPostCustomerService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostCustomerServiceTest extends KernelTestCase
{
    public function testPostCustomerService()
    {
        self::bootKernel();
        $container = static::getContainer();

        $postService = $container->get(IPostCustomerService::class);

        $customer = [
            'name' => 'Jan Kowalski'
        ];

        $customerDTO = new CustomerDTO($customer['name']);

        $serviceResult = $postService->create($customerDTO);

        $this->assertEquals(true, $serviceResult instanceof Customer);
        $this->assertEquals($serviceResult->getName(), $customer['name']);
    }

}