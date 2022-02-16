<?php

namespace App\Factory\Customer;

use App\Entity\Customer;
use App\Repository\Interface\ICustomerRepository;

class CustomerFactory implements ICustomerFactory
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
     * @param string $name
     * @return Customer
     */
    public function create(string $name): Customer {
        $customer = new Customer();
        $customer->setName($name);
        $this->customerRepository->save($customer);
        return $customer;
    }

}