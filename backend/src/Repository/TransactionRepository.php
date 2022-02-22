<?php

namespace App\Repository;

use App\Entity\Customer;
use App\Entity\Transaction;
use App\Repository\Interfaces\ITransactionRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Transaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transaction[]    findAll()
 * @method Transaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransactionRepository extends ServiceEntityRepository implements ITransactionRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

    public function save(Transaction $transaction): Transaction
    {
        $this->_em->persist($transaction);
        $this->_em->flush();

        return $transaction;
    }

    public function delete(Transaction $transaction): void
    {
        $this->_em->remove($transaction);
        $this->_em->flush();
    }

    public function findAllTransaction(): array
    {
        return $this->findAll();
    }

    public function findOneByTransaction(array $criteria): ?Transaction
    {
        return $this->findOneBy($criteria);
    }

    public function findByCustomerAndDateTransaction(Customer $customer, string $dateStart): array
    {
        return $this->createQueryBuilder('transaction')
            ->andWhere('transaction.transactionDate >= :dateStart')
            ->andWhere('transaction.customer = :customer')
            ->setParameter('dateStart', $dateStart . ' 00:00:00')
            ->setParameter('customer', $customer)
            ->getQuery()
            ->getResult();
    }
}
