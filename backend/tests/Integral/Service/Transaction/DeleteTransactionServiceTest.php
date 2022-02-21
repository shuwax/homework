<?php

namespace Service\Customer;

use App\DTO\CustomerDTO;
use App\DTO\TransactionDTO;
use App\Entity\Customer;
use App\Entity\Transaction;
use App\Service\Customer\IPostCustomerService;
use App\Service\Transaction\IDeleteTransactionService;
use App\Service\Transaction\IPostTransactionService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DeleteTransactionServiceTest extends KernelTestCase
{
    public function testDeleteTransactionService()
    {
        self::bootKernel();
        $container = static::getContainer();

        $customerPostService = $container->get(IPostCustomerService::class);
        $transactionPostService = $container->get(IPostTransactionService::class);
        $transactionDeleteService = $container->get(IDeleteTransactionService::class);

        $customerData = [
            'name' => 'Jan Kowalski'
        ];
        $customerDTO = new CustomerDTO($customerData['name']);
        /** @var Customer $customer */
        $customer = $customerPostService->create($customerDTO);

        $transactionData = [
            'value' => 120,
            'customerId' => $customer->getId(),
            'transactionDate' => '2021-01-01'
        ];

        $transactionDTO = new TransactionDTO($transactionData['value'], $transactionData['customerId'], $transactionData['transactionDate']);
        $transactionDTO->setCustomer($customer);

        /** @var Transaction $transaction */
        $transaction = $transactionPostService->create($transactionDTO);

        $transactionDeleteService->delete($transaction->getId());
        $this->assertEquals(null, $transaction->getId());
    }

}