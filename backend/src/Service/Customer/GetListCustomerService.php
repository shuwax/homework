<?php

namespace App\Service\Customer;

use App\Repository\Interfaces\ICustomerRepository;

class GetListCustomerService implements IGetListCustomerService
{
    private ICustomerRepository $customerRepository;

    public function __construct(ICustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getList(): array
    {
        return $this->customerRepository->findAll();
    }
}