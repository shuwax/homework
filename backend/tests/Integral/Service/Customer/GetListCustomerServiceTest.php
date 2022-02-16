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

        $this->assertEquals(is_array($serviceResult), true);
        $this->assertEquals(count($serviceResult), 0);
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

        $this->assertEquals(is_array($serviceResult), true);
        $this->assertEquals(count($serviceResult), 1);
    }

}