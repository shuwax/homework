<?php

namespace App\Service\Transaction;

use App\DTO\TransactionUpdateDTO;
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

    public function put(int $transactionId, TransactionUpdateDTO $transactionUpdateDTO): Transaction
    {
        $transaction = $this->transactionRepository->findOneByTransaction(['id' => $transactionId]);

        if (!$transaction) {
            throw new NotFoundHttpException();
        }
        $transaction = $this->transactionUpdate->update($transaction, $transactionUpdateDTO);
        $this->transactionRepository->save($transaction);

        return $transaction;
    }
}