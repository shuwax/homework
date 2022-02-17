<?php

namespace App\Event\ControllerHandler\Customer;


use Symfony\Contracts\EventDispatcher\Event;


class DeleteCustomerEvent extends Event
{

    public const NAME = 'controller.action.customer.deleteCustomer';


    private int $customerId;

    public function __construct(int $customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }


}