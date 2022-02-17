<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TransactionRepository::class)
 */
class Transaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"transaction:post", "transaction:list", "transaction:show", "transaction:put"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"transaction:post", "transaction:list", "transaction:show", "transaction:put"})
     *
     */
    private $value;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"transaction:post", "transaction:list", "transaction:show", "transaction:put"})
     *
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"transaction:post", "transaction:list", "transaction:show", "transaction:put"})
     *
     */
    private $customer;

    public function __construct()
    {
        $this->updateTimestamps();
    }

    public function updateTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if (null == $this->getCreatedAt()) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
