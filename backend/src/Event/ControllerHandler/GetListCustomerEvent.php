<?php

namespace App\Event\ControllerHandler;


use Symfony\Contracts\EventDispatcher\Event;


class GetListCustomerEvent extends Event
{

    public const NAME = 'controller.action.customer.getListCustomers';


    private array $customers = [];

    /**
     * @return array
     */
    public function getCustomers(): array
    {
        return $this->customers;
    }

    /**
     * @param array $customers
     */
    public function setCustomers(array $customers): void
    {
        $this->customers = $customers;
    }

}