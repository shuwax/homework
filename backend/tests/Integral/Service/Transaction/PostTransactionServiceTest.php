<?php

namespace Service\Customer;

use App\Entity\Customer;
use App\Entity\Transaction;
use App\Service\Customer\IPostCustomerService;
use App\Service\Transaction\IGetOneTransactionService;
use App\Service\Transaction\IPostTransactionService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostTransactionServiceTest extends KernelTestCase
{
    public function testPostTransactionService()
    {
        self::bootKernel();
        $container = static::getContainer();

        $customerPostService = $container->get(IPostCustomerService::class);
        $transactionPostService = $container->get(IPostTransactionService::class);
        $transactionGetOneService = $container->get(IGetOneTransactionService::class);

        $customerData = [
            'name' => 'Jan Kowalski'
        ];
        /** @var Customer $customer */
        $customer = $customerPostService->create($customerData);

        $transactionData = [
            'value' => 120,
            'customerId' => $customer->getId()
        ];
        /** @var Transaction $transaction */
        $transaction = $transactionPostService->create($transactionData);

        /** @var Transaction $transactionFromGetOne */
        $transactionFromGetOne = $transactionGetOneService->getOne($transaction->getId());
        $this->assertEquals(true, $transactionFromGetOne instanceof Transaction);
        $this->assertEquals($transactionFromGetOne->getValue(), $transactionData['value']);
        $this->assertEquals($transactionFromGetOne->getRawValue(), $transactionData['value'] * 100);
        $this->assertEquals($transactionFromGetOne->getCustomer()->getName(), $customerData['name']);

        $this->assertGreaterThanOrEqual($transactionFromGetOne->getCreatedAt(), new \DateTime('now'));
        $this->assertGreaterThanOrEqual($transactionFromGetOne->getUpdatedAt(), new \DateTime('now'));
    }

}