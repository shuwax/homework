<?php

namespace App\Service\Customer;

use App\Entity\Customer;
use App\Repository\Interfaces\ICustomerRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetCustomerService implements IGetCustomerService
{
    private ICustomerRepository $customerRepository;

    public function __construct(ICustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function get(int $customerId): ?Customer
    {
        $customer = $this->customerRepository->findOneByCustomers(['id' => $customerId]);
        if (!$customer) {
            throw new NotFoundHttpException();
        }
        return $customer;
    }
}