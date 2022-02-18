<?php

namespace Service\Customer;

use App\DTO\CustomerDTO;
use App\DTO\TransactionDTO;
use App\DTO\TransactionUpdateDTO;
use App\Entity\Customer;
use App\Entity\Transaction;
use App\Service\Customer\IPostCustomerService;
use App\Service\Transaction\IPostTransactionService;
use App\Service\Transaction\IPutTransactionService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PutTransactionServiceTest extends KernelTestCase
{
    public function testPostTransactionService()
    {
        self::bootKernel();
        $container = static::getContainer();

        $customerPostService = $container->get(IPostCustomerService::class);
        $transactionPostService = $container->get(IPostTransactionService::class);
        $transactionPutService = $container->get(IPutTransactionService::class);

        $customerData = [
            'name' => 'Jan Kowalski'
        ];
        $customerDTO = new CustomerDTO($customerData['name']);

        /** @var Customer $customer */
        $customer = $customerPostService->create($customerDTO);

        $transactionData = [
            'value' => 120,
            'customerId' => $customer->getId()
        ];

        $transactionDTO = new TransactionDTO($transactionData['value'], $transactionData['customerId']);
        $transactionDTO->setCustomer($customer);

        /** @var Transaction $transaction */
        $transaction = $transactionPostService->create($transactionDTO);

        $transactionUpdateData = [
            'value' => 130
        ];
        $transactionDTO = new TransactionUpdateDTO($transactionUpdateData['value']);


        /** @var Transaction $transactionFromGetOne */
        $transactionUpdate = $transactionPutService->put($transaction->getId(), $transactionDTO);

        $this->assertEquals(true, $transactionUpdate instanceof Transaction);
        $this->assertEquals($transactionUpdate->getValue(), $transactionUpdateData['value']);
        $this->assertEquals($transactionUpdate->getRawValue(), $transactionUpdateData['value'] * 100);
        $this->assertEquals($transactionUpdate->getCustomer()->getName(), $customerData['name']);

        $this->assertGreaterThanOrEqual($transactionUpdate->getCreatedAt(), new \DateTime('now'));
        $this->assertGreaterThanOrEqual($transactionUpdate->getUpdatedAt(), new \DateTime('now'));
    }

}