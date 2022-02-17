<?php

namespace App\Service\Transaction;


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
        ITransactionFactory $transactionFactory,
        ICustomerRepository $customerRepository,
        ITransactionRepository $transactionRepository
    )
    {
        $this->transactionFactory = $transactionFactory;
        $this->customerRepository = $customerRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function create(array $data): Transaction
    {
        $customer = $this->customerRepository->findOneByCustomers(['id' => $data['customerId']]);

        if (!$customer) {
            throw new NotFoundHttpException();
        }
        $data['customer'] = $customer;

        $transaction = $this->transactionFactory->create($data);
        $this->transactionRepository->save($transaction);
        return $transaction;
    }
}