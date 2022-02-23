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
     * @var string
     */
    private DateTimeInterface $transactionDate;

    /**
     * @Assert\NotNull
     * @Assert\Valid
     */
    private Customer $customer;

    public function __construct(float $value, Customer $customer, string $transactionDate)
    {
        $this->value = $value;
        $this->customer = $customer;
        $this->transactionDate = new DateTime($transactionDate);
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

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }


}