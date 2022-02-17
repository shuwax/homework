<?php

namespace App\Event\ControllerHandler\Customer;


use App\Entity\Customer;
use Symfony\Contracts\EventDispatcher\Event;


class CreateCustomerEvent extends Event
{

    public const NAME = 'controller.action.customer.createCustomer';


    private array $customerData = [];


    private ?Customer $customer = null;

    public function __construct(array $customerData)
    {
        $this->customerData = $customerData;
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