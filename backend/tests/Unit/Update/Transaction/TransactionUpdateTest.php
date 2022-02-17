<?php

namespace Update\Transaction;

use App\Entity\Customer;
use App\Factory\Customer\CustomerFactory;
use App\Factory\Transaction\TransactionFactory;
use App\Update\Transaction\TransactionUpdate;
use PHPUnit\Framework\TestCase;

class TransactionUpdateTest extends TestCase
{
    public function testCustomerFactory()
    {

        $customerFactory = new CustomerFactory();
        $transactionFactory = new TransactionFactory();
        $transactionUpdate = new TransactionUpdate();

        $customerData = ["name" => 'Jan Kowalski'];
        $customer = $customerFactory->create($customerData);

        $transactionData = ["value" => 12000, "customerId" => 1];
        $transactionData['customer'] = $customer;

        $transaction = $transactionFactory->create($transactionData);

        $transactionUpdateData = ["value" => 13000];

        /** @var Customer $customer */
        $transaction = $transactionUpdate->update($transaction, $transactionUpdateData);
        $this->assertEquals($transaction->getValue(), $transactionUpdateData['value']);
        $this->assertNotEquals($transaction->getValue(), $transactionData['value']);
    }

}