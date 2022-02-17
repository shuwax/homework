<?php

namespace App\Service\Customer;


use App\Entity\Customer;
use App\Factory\Customer\ICustomerFactory;
use App\Repository\Interfaces\ICustomerRepository;

class PostCustomerService implements IPostCustomerService
{

    private ICustomerFactory $customerFactory;
    private ICustomerRepository $customerRepository;

    public function __construct(
        ICustomerFactory $customerFactory,
        ICustomerRepository $customerRepository
    )
    {
        $this->customerFactory = $customerFactory;
        $this->customerRepository = $customerRepository;
    }

    public function create(array $data): Customer
    {
        $customer = $this->customerFactory->create($data);
        $this->customerRepository->save($customer);
        return $customer;
    }
}