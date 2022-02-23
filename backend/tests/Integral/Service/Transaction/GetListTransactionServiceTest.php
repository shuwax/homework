<?php

namespace Service\Transaction;

use App\DTO\CustomerDTO;
use App\DTO\TransactionDTO;
use App\Service\Customer\IPostCustomerService;
use App\Service\Transaction\IGetListTransactionService;
use App\Service\Transaction\IPostTransactionService;
use App\Tools\Date\DateHandler;
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
            'customer' => $customer,
            'transactionDate' => '2021-01-01'
        ];

        $transactionDTO = new TransactionDTO($transactionData['value'], $transactionData['customer'], $transactionData['transactionDate']);
        $transactionDTO->setCustomer($customer);

        $transactionPostService->create($transactionDTO);

//        Check List
        $getListService = $container->get(IGetListTransactionService::class);
        $serviceResult = $getListService->getList();

        $this->assertEquals(true, is_array($serviceResult));
        $this->assertCount(1, $serviceResult);
    }


    public function testGetListTransactionPeriodByCustomerEmptyService()
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
            'customer' => $customer,
            'transactionDate' => '2021-01-01'
        ];

        $transactionDTO = new TransactionDTO($transactionData['value'], $transactionData['customer'], $transactionData['transactionDate']);
        $transactionDTO->setCustomer($customer);

        $transactionPostService->create($transactionDTO);

//        Check List
        $getListService = $container->get(IGetListTransactionService::class);
        $serviceResult = $getListService->getListPeriodTimeByCustomer($customer);

        $this->assertEquals(true, is_array($serviceResult));
        $this->assertCount(0, $serviceResult);
    }

    public function testGetListTransactionPeriodByCustomerService()
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

        $dateHandler = new DateHandler();
//        Create Transaction
        $transactionPostService = $container->get(IPostTransactionService::class);
        $transactionData = [
            'value' => 120,
            'customer' => $customer,
            'transactionDate' => $dateHandler->formatDate($dateHandler->getCurrentDate(), 'Y-m-d')
        ];

        $transactionDTO = new TransactionDTO($transactionData['value'], $transactionData['customer'], $transactionData['transactionDate']);
        $transactionDTO->setCustomer($customer);

        $transactionPostService->create($transactionDTO);

//        Check List
        $getListService = $container->get(IGetListTransactionService::class);
        $serviceResult = $getListService->getListPeriodTimeByCustomer($customer);

        $this->assertEquals(true, is_array($serviceResult));
        $this->assertCount(1, $serviceResult);
    }


    public function testGetListTransactionByCustomerEmptyService()
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
            'customer' => $customer,
            'transactionDate' => '2021-01-01'
        ];

        $transactionDTO = new TransactionDTO($transactionData['value'], $transactionData['customer'], $transactionData['transactionDate']);
        $transactionDTO->setCustomer($customer);

        $transactionPostService->create($transactionDTO);

//        Check List
        $getListService = $container->get(IGetListTransactionService::class);
        $serviceResult = $getListService->getListByCustomer($customer);

        $this->assertEquals(true, is_array($serviceResult));
        $this->assertCount(1, $serviceResult);
    }

    public function testGetListTransactionByCustomerService()
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

        $dateHandler = new DateHandler();
//        Create Transaction
        $transactionPostService = $container->get(IPostTransactionService::class);
        $transactionData = [
            'value' => 120,
            'customer' => $customer,
            'transactionDate' => $dateHandler->formatDate($dateHandler->getCurrentDate(), 'Y-m-d')
        ];

        $transactionDTO = new TransactionDTO($transactionData['value'], $transactionData['customer'], $transactionData['transactionDate']);
        $transactionDTO->setCustomer($customer);

        $transactionPostService->create($transactionDTO);

//        Check List
        $getListService = $container->get(IGetListTransactionService::class);
        $serviceResult = $getListService->getListByCustomer($customer);

        $this->assertEquals(true, is_array($serviceResult));
        $this->assertCount(1, $serviceResult);
    }
}