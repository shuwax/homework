<?php

namespace Service\Customer;

use App\DTO\CustomerDTO;
use App\DTO\TransactionDTO;
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
        $customerDTO = new CustomerDTO($customerData['name']);
        $customer = $customerPostService->create($customerDTO);

//        Create Transaction
        $transactionPostService = $container->get(IPostTransactionService::class);
        $transactionData = [
            'value' => 120,
            'customerId' => $customer->getId()
        ];

        $transactionDTO = new TransactionDTO($transactionData['value'], $transactionData['customerId']);
        $transactionDTO->setCustomer($customer);

        $transactionPostService->create($transactionDTO);

//        Check List
        $getListService = $container->get(IGetListTransactionService::class);
        $serviceResult = $getListService->getList();

        $this->assertEquals(true, is_array($serviceResult));
        $this->assertCount(1, $serviceResult);
    }

}