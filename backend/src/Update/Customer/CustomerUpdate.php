<?php

namespace App\Update\Customer;

use App\Entity\Customer;
use App\Repository\Interfaces\ICustomerRepository;

class CustomerUpdate implements ICustomerUpdate
{
    /**
     * @var ICustomerRepository
     */
    private ICustomerRepository $customerRepository;

    /**
     * @param ICustomerRepository $customerRepository
     */
    public function __construct(ICustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param Customer $customer
     * @param string $name
     * @return Customer
     */
    public function update(Customer $customer, string $name): Customer {
        $customer->setName($name);
        $this->customerRepository->save($customer);
        return $customer;
    }

}