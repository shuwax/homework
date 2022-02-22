<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast\Double;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TransactionRepository::class)
 */
class Transaction
{

    const DAY_PERIOD_TRANSACTIONS = '-90';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"transaction:post", "transaction:list", "transaction:show", "transaction:put", "customer:show:transactions", "transaction:list:period"})
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups({"transaction:post", "transaction:list", "transaction:show", "transaction:put", "customer:show:transactions", "transaction:list:period"})
     *
     */
    private float $value;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"transaction:post", "transaction:list", "transaction:show", "transaction:put"})
     */
    private int $rawValue;

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
    private Customer $customer;

    /**
     * @ORM\Column(type="date")
     * @Groups({"transaction:post", "transaction:list", "transaction:show", "transaction:put", "customer:show:transactions", "transaction:list:period"})
     */
    private DateTimeInterface $transactionDate;



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

    public function getRawValue(): ?int
    {
        return $this->rawValue;
    }


    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;
        $this->rawValue = intval($value * 100);

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

    public function getTransactionDate(): ?\DateTimeInterface
    {
        return $this->transactionDate;
    }

    public function setTransactionDate(\DateTimeInterface $transactionDate): self
    {
        $this->transactionDate = $transactionDate;

        return $this;
    }

    /**
     * @return int
     *
     * @Groups({"customer:show:transactions", "transaction:list:period"})
     */
    public function getTransactionDateTimeStamp(): int
    {
        $transactionDate = $this->transactionDate;

        return $transactionDate->getTimestamp();
    }

}
