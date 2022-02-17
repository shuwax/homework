<?php

namespace App\Event\ControllerHandler\Customer;


use App\Entity\Customer;
use Symfony\Contracts\EventDispatcher\Event;


class UpdateCustomerEvent extends Event
{

    public const NAME = 'controller.action.customer.updateCustomer';


    private array $customerData;

    private int $customerId;

    private ?Customer $customer = null;

    public function __construct(array $customerData, int $customerId)
    {
        $this->customerData = $customerData;
        $this->customerId = $customerId;
    }

    /**
     * @return array|int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @return array
     */
    public function getCustomerData(): array
    {
        return $this->customerData;
    }


    /**
     * @return Customer|null
     */
    public function getCustomer(): ?Customer
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