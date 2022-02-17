<?php

namespace App\Event\ControllerHandler\Customer;


use App\Entity\Customer;
use Symfony\Contracts\EventDispatcher\Event;


class GetOneCustomerEvent extends Event
{

    public const NAME = 'controller.action.customer.getOneCustomer';


    private int $customerId;


    private ?Customer $customer = null;

    public function __construct(int $customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
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