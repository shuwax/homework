<?php

namespace App\Service\Customer;


use App\DTO\CustomerDTO;
use App\Entity\Customer;
use App\Factory\Customer\ICustomerFactory;
use App\Repository\Interfaces\ICustomerRepository;

class PostCustomerService implements IPostCustomerService
{

    private ICustomerFactory $customerFactory;
    private ICustomerRepository $customerRepository;

    public function __construct(
        ICustomerFactory    $customerFactory,
        ICustomerRepository $customerRepository
    )
    {
        $this->customerFactory = $customerFactory;
        $this->customerRepository = $customerRepository;
    }

    public function create(CustomerDTO $customerDTO): Customer
    {
        $customer = $this->customerFactory->create($customerDTO);
        $this->customerRepository->save($customer);
        return $customer;
    }
}