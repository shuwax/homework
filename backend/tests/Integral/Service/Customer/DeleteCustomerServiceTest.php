<?php

namespace Service\Customer;

use App\DTO\CustomerDTO;
use App\Service\Customer\IDeleteCustomerService;
use App\Service\Customer\IPostCustomerService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DeleteCustomerServiceTest extends KernelTestCase
{
    public function testDeleteCustomerService()
    {
        self::bootKernel();
        $container = static::getContainer();

        $postService = $container->get(IPostCustomerService::class);
        $deleteService = $container->get(IDeleteCustomerService::class);

        $customer = [
            'name' => 'Jan Kowalski'
        ];
        $customerDTO = new CustomerDTO($customer['name']);

        $servicePostResult = $postService->create($customerDTO);

        $deleteService->delete($servicePostResult->getId());
        $this->assertEquals(null, $servicePostResult->getId());
    }

}