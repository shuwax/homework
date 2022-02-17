<?php

namespace App\Service\Customer;


use App\Entity\Customer;
use App\Repository\Interfaces\ICustomerRepository;
use App\Update\Customer\ICustomerUpdate;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PutCustomerService implements IPutCustomerService
{

    private ICustomerRepository $customerRepository;

    private ICustomerUpdate $customerUpdate;

    public function __construct(
        ICustomerRepository $customerRepository,
        ICustomerUpdate     $customerUpdate
    )
    {
        $this->customerUpdate = $customerUpdate;
        $this->customerRepository = $customerRepository;
    }


    public function put(int $customerId, array $data): Customer
    {
        $customer = $this->customerRepository->findOneByCustomers(['id' => $customerId]);
        if (!$customer) {
            throw new NotFoundHttpException();
        }

        $customer = $this->customerUpdate->update($customer, $data);
        $this->customerRepository->save($customer);
        return $customer;
    }
}