<?php

namespace App\DTO;

use App\Entity\Customer;
use Symfony\Component\Validator\Constraints as Assert;

class TransactionUpdateDTO
{

    /**
     * @Assert\NotBlank
     * @Assert\GreaterThan(0)
     * @var float
     */
    private float $value;


    public function __construct(float $value)
    {
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
}