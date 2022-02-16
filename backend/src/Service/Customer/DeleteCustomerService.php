<?php

namespace App\Service\Customer;

use App\Repository\Interfaces\ICustomerRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeleteCustomerService implements IDeleteCustomerService
{

    private ICustomerRepository $customerRepository;

    public function __construct(
        ICustomerRepository $customerRepository
    )
    {
        $this->customerRepository = $customerRepository;
    }

    public function delete(int $customerId): void
    {
        $customer = $this->customerRepository->findOneByCustomers(['id' => $customerId]);
        if (!$customer) {
            throw new NotFoundHttpException();
        }

        $this->customerRepository->delete($customer);
    }
}