<?php

namespace App\DTO;

use App\Entity\Customer;
use DateTime;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

class TransactionUpdateDTO
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


    public function __construct(float $value, string $transactionDate)
    {
        $this->transactionDate = new DateTime($transactionDate);
        $this->value = $value;
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

}