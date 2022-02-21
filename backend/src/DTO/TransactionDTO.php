<?php

namespace App\DTO;

use App\Entity\Customer;
use DateTime;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

class TransactionDTO
{

    /**
     * @Assert\NotBlank
     * @Assert\GreaterThan(0)
     * @var float
     */
    private float $value;

    /**
     * @Assert\NotBlank
     * @Assert\GreaterThan(0)
     * @var integer
     */
    private int $customerId;

    /**
     * @Assert\NotBlank
     * @var string
     */
    private DateTimeInterface $transactionDate;

    private ?Customer $customer;

    public function __construct(float $value, int $customerId, string $transactionDate)
    {
        $this->value = $value;
        $this->customerId = $customerId;
        $this->transactionDate = new DateTime($transactionDate);
        $this->customer = null;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     */
    public function setCustomerId(int $customerId): void
    {
        $this->customerId = $customerId;
    }

    /**
     * @return Customer|null
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer|null $customer
     */
    public function setCustomer(?Customer $customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return DateTimeInterface
     */
    public function getTransactionDate(): DateTimeInterface
    {
        return $this->transactionDate;
    }

    /**
     * @param DateTimeInterface $transactionDate
     */
    public function setTransactionDate(DateTimeInterface $transactionDate): void
    {
        $this->transactionDate = $transactionDate;
    }



}