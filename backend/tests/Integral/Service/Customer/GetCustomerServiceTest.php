<?php

namespace Service\Customer;

use App\Entity\Customer;
use App\Service\Customer\IGetCustomerService;
use App\Service\Customer\IPostCustomerService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetCustomerServiceTest extends KernelTestCase
{

    public function testGetCustomerServiceFail()
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->expectException(NotFoundHttpException::class);
        $getService = $container->get(IGetCustomerService::class);
        $getService->get(-1);
    }

    public function testGetCustomerService()
    {
        self::bootKernel();
        $container = static::getContainer();
//        Create Customer
        $postService = $container->get(IPostCustomerService::class);
        $customer = [
            'name' => 'Jan Kowalski'
        ];
        /** @var Customer $customer */
        $customer = $postService->create($customer);

        $getService = $container->get(IGetCustomerService::class);
        /** @var Customer $serviceResult */
        $serviceResult = $getService->get($customer->getId());

        $this->assertEquals($customer->getId(), $serviceResult->getId());
    }


}