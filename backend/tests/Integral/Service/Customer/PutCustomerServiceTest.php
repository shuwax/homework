<?php

namespace Service\Customer;

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

        $servicePostResult = $postService->create($customer);

        $servicePutResult = $putService->put($servicePostResult->getId(), $customerUpdate);

        $this->assertEquals(true, $servicePutResult instanceof Customer);
        $this->assertEquals($servicePutResult->getName(), $customerUpdate['name']);
    }

}