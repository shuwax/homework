<?php

namespace Service\Customer;

use App\Service\Customer\IGetListCustomerService;
use App\Service\Customer\IPostCustomerService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GetListCustomerServiceTest extends KernelTestCase
{
    public function testGetEmptyListCustomerService()
    {
        self::bootKernel();
        $container = static::getContainer();

        $getListService = $container->get(IGetListCustomerService::class);

        $serviceResult = $getListService->getList();

        $this->assertEquals(true, is_array($serviceResult));
        $this->assertCount(0, $serviceResult);
    }

    public function testGetListCustomerService()
    {
        self::bootKernel();
        $container = static::getContainer();

//        Create Customer
        $postService = $container->get(IPostCustomerService::class);
        $customer = [
            'name' => 'Jan Kowalski'
        ];
        $postService->create($customer);

//        Check List
        $getListService = $container->get(IGetListCustomerService::class);
        $serviceResult = $getListService->getList();

        $this->assertEquals(true, is_array($serviceResult));
        $this->assertCount(1, $serviceResult);
    }

}