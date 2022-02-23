<?php

namespace App\Service\Transaction;

use App\DTO\TransactionDTO;
use App\Entity\Transaction;
use App\Repository\Interfaces\ITransactionRepository;
use App\Update\Transaction\ITransactionUpdate;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PutTransactionService implements IPutTransactionService
{

    private ITransactionRepository $transactionRepository;
    private ITransactionUpdate $transactionUpdate;

    public function __construct(
        ITransactionRepository $transactionRepository,
        ITransactionUpdate     $transactionUpdate
    )
    {
        $this->transactionRepository = $transactionRepository;
        $this->transactionUpdate = $transactionUpdate;
    }

    public function put(int $transactionId, TransactionDTO $transactionDTO): Transaction
    {
        $transaction = $this->transactionRepository->findOneByTransaction(['id' => $transactionId]);

        if (!$transaction) {
            throw new NotFoundHttpException();
        }
        $transaction = $this->transactionUpdate->update($transaction, $transactionDTO);
        $this->transactionRepository->save($transaction);

        return $transaction;
    }
}