<?php

namespace Service\Customer;

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
        /** @var Customer $customer */
        $customer = $customerPostService->create($customerData);

        $transactionData = [
            'value' => 120,
            'customerId' => $customer->getId()
        ];
        /** @var Transaction $transaction */
        $transaction = $transactionPostService->create($transactionData);

        $transactionDeleteService->delete($transaction->getId());
        $this->assertEquals(null, $transaction->getId());
    }

}