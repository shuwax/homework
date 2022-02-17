<?php

namespace App\Service\Transaction;


use App\Entity\Transaction;
use App\Repository\Interfaces\ITransactionRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetOneTransactionService implements IGetOneTransactionService
{

    private ITransactionRepository $transactionRepository;

    public function __construct(
        ITransactionRepository $transactionRepository
    )
    {
        $this->transactionRepository = $transactionRepository;
    }


    public function getOne(int $transactionId): Transaction
    {
        $transaction = $this->transactionRepository->findOneByTransaction(['id' => $transactionId]);

        if (!$transaction) {
            throw new NotFoundHttpException();
        }
        return $transaction;
    }
}