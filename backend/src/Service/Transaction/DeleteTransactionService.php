<?php

namespace App\Service\Transaction;

use App\Repository\Interfaces\ITransactionRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeleteTransactionService implements IDeleteTransactionService
{

    private ITransactionRepository $transactionRepository;

    public function __construct(
        ITransactionRepository $transactionRepository
    )
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function delete(int $transactionId): void
    {
        $transaction = $this->transactionRepository->findOneByTransaction(['id' => $transactionId]);

        if (!$transaction) {
            throw new NotFoundHttpException();
        }

        $this->transactionRepository->delete($transaction);
    }
}