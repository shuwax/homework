<?php

namespace App\Event\ControllerHandler\Customer;


use App\DTO\CustomerDTO;
use App\Entity\Customer;
use Symfony\Contracts\EventDispatcher\Event;


class UpdateCustomerEvent extends Event
{

    public const NAME = 'controller.action.customer.updateCustomer';


    private CustomerDTO $customerDTO;

    private int $customerId;

    private ?Customer $customer = null;

    public function __construct(CustomerDTO $customerDTO, int $customerId)
    {
        $this->customerDTO = $customerDTO;
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
     * @return CustomerDTO
     */
    public function getCustomerDTO(): CustomerDTO
    {
        return $this->customerDTO;
    }

    /**
     * @param CustomerDTO $customerDTO
     */
    public function setCustomerDTO(CustomerDTO $customerDTO): void
    {
        $this->customerDTO = $customerDTO;
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