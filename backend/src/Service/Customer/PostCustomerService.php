<?php

namespace App\Service\Customer;


use App\Entity\Customer;
use App\Factory\Customer\CustomerFactory;

class PostCustomerService implements IPostCustomerService
{

    private CustomerFactory $customerFactory;

    public function __construct(CustomerFactory $customerFactory)
    {
        $this->customerFactory = $customerFactory;
    }

    public function create(array $data): Customer
    {
        return $this->customerFactory->create($data['name']);
    }
}