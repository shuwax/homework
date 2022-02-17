<?php

namespace App\Service\Transaction;

use App\Repository\Interfaces\ITransactionRepository;

class GetListTransactionService implements IGetListTransactionService
{
    private ITransactionRepository $transactionRepository;

    public function __construct(
        ITransactionRepository $transactionRepository
    )
    {
        $this->transactionRepository = $transactionRepository;
    }


    public function getList(): array
    {
        return $this->transactionRepository->findAllTransaction();
    }
}