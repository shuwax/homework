<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class CustomerDTO
{

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *        min = 1,
     *        minMessage = "Your name must be at least {{ limit }} characters long"
     * )
     * @var string
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

}