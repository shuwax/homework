<?php

namespace App\Event\ControllerHandler\Customer;


use App\DTO\CustomerDTO;
use App\Entity\Customer;
use Symfony\Contracts\EventDispatcher\Event;


class CreateCustomerEvent extends Event
{

    public const NAME = 'controller.action.customer.createCustomer';


    private CustomerDTO $customerDTO;


    private ?Customer $customer = null;

    public function __construct(CustomerDTO $customerDTO)
    {
        $this->customerDTO = $customerDTO;
    }

    /**
     * @return CustomerDTO
     */
    public function getCustomerDTO(): CustomerDTO
    {
        return $this->customerDTO;
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