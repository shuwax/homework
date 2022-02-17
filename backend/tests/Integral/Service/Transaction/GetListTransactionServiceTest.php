<?php

namespace Service\Customer;

use App\Service\Customer\IPostCustomerService;
use App\Service\Transaction\IGetListTransactionService;
use App\Service\Transaction\IPostTransactionService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GetListTransactionServiceTest extends KernelTestCase
{
    public function testGetEmptyListTransactionService()
    {
        self::bootKernel();
        $container = static::getContainer();

        $getListService = $container->get(IGetListTransactionService::class);

        $serviceResult = $getListService->getList();

        $this->assertEquals(true, is_array($serviceResult));
        $this->assertCount(0, $serviceResult);
    }

    public function testGetListTransactionService()
    {
        self::bootKernel();
        $container = static::getContainer();

//        Create Customer
        $customerPostService = $container->get(IPostCustomerService::class);
        $customerData = [
            'name' => 'Jan Kowalski'
        ];

        $customer = $customerPostService->create($customerData);

//        Create Transaction
        $transactionPostService = $container->get(IPostTransactionService::class);
        $transactionData = [
            'value' => 12000,
            'customerId' => $customer->getId()
        ];
        $transactionPostService->create($transactionData);

//        Check List
        $getListService = $container->get(IGetListTransactionService::class);
        $serviceResult = $getListService->getList();

        $this->assertEquals(true, is_array($serviceResult));
        $this->assertCount(1, $serviceResult);
    }

}