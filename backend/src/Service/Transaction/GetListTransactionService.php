<?php

namespace App\Service\Transaction;

use App\Entity\Customer;
use App\Entity\Transaction;
use App\Repository\Interfaces\ITransactionRepository;
use App\Tools\Date\IDateHandler;

class GetListTransactionService implements IGetListTransactionService
{
    private ITransactionRepository $transactionRepository;

    private IDateHandler $dateHandler;

    public function __construct(
        ITransactionRepository $transactionRepository,
        IDateHandler $dateHandler
    )
    {
        $this->transactionRepository = $transactionRepository;
        $this->dateHandler = $dateHandler;
    }


    public function getList(): array
    {
        return $this->transactionRepository->findAllTransaction();
    }

    public function getListPeriodTime(Customer $customer): array
    {
        $periodDate = $this->dateHandler->formatDate($this->dateHandler->addToCurrentDateDays(Transaction::DAY_PERIOD_TRANSACTIONS), 'Y-m-d');
        return $this->transactionRepository->findByCustomerAndDateTransaction($customer, $periodDate);
    }
}