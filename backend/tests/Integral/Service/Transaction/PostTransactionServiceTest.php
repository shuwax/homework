<?php

namespace Service\Customer;

use App\Entity\Customer;
use App\Entity\Transaction;
use App\Service\Customer\IPostCustomerService;
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

        $customerData = [
            'name' => 'Jan Kowalski'
        ];
        /** @var Customer $customer */
        $customer = $customerPostService->create($customerData);

        $transactionData = [
            'value' => 12000,
            'customerId' => $customer->getId()
        ];
        /** @var Transaction $transaction */
        $transaction = $transactionPostService->create($transactionData);

        $this->assertEquals(true, $transaction instanceof Transaction);
        $this->assertEquals($transaction->getValue(), $transactionData['value']);
        $this->assertEquals($transaction->getCustomer()->getName(), $customerData['name']);

        $this->assertGreaterThanOrEqual($transaction->getCreatedAt(), new \DateTime('now'));
        $this->assertGreaterThanOrEqual($transaction->getUpdatedAt(), new \DateTime('now'));
    }

}