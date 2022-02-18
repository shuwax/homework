<?php

namespace Service\Customer;

use App\DTO\CustomerDTO;
use App\Entity\Customer;
use App\Service\Customer\IPostCustomerService;
use App\Service\Customer\IPutCustomerService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PutCustomerServiceTest extends KernelTestCase
{
    public function testPutCustomerService()
    {
        self::bootKernel();
        $container = static::getContainer();

        $postService = $container->get(IPostCustomerService::class);
        $putService = $container->get(IPutCustomerService::class);

        $customer = [
            'name' => 'Jan Kowalski'
        ];
        $customerUpdate = [
            'name' => 'Monika Kowalski'
        ];

        $customerDTO = new CustomerDTO($customer['name']);
        $customerUpdateDTO = new CustomerDTO($customerUpdate['name']);
        $servicePostResult = $postService->create($customerDTO);

        $servicePutResult = $putService->put($servicePostResult->getId(), $customerUpdateDTO);

        $this->assertEquals(true, $servicePutResult instanceof Customer);
        $this->assertEquals($servicePutResult->getName(), $customerUpdate['name']);
    }

}