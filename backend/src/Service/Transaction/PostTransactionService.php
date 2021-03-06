<?php

namespace App\Service\Transaction;


use App\DTO\TransactionDTO;
use App\Entity\Transaction;
use App\Factory\Transaction\ITransactionFactory;
use App\Repository\Interfaces\ICustomerRepository;
use App\Repository\Interfaces\ITransactionRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostTransactionService implements IPostTransactionService
{

    private ITransactionFactory $transactionFactory;
    private ICustomerRepository $customerRepository;
    private ITransactionRepository $transactionRepository;

    public function __construct(
        ITransactionFactory    $transactionFactory,
        ICustomerRepository    $customerRepository,
        ITransactionRepository $transactionRepository
    )
    {
        $this->transactionFactory = $transactionFactory;
        $this->customerRepository = $customerRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function create(TransactionDTO $transactionDTO): Transaction
    {
        $customer = $this->customerRepository->findOneByCustomers(['id' => $transactionDTO->getCustomer()->getId()]);

        if (!$customer) {
            throw new NotFoundHttpException();
        }
        $transactionDTO->setCustomer($customer);

        $transaction = $this->transactionFactory->create($transactionDTO);
        $customer->addTransaction($transaction);
        $this->transactionRepository->save($transaction);
        $this->customerRepository->save($customer);
        return $transaction;
    }
}