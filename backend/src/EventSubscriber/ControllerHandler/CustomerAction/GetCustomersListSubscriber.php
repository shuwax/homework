<?php

namespace App\EventSubscriber\ControllerHandler\CustomerAction;

use App\Event\ControllerHandler\GetListCustomerEvent;
use App\Service\Customer\IGetListCustomerService;
use App\Service\Logger\ILoggerService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GetCustomersListSubscriber implements EventSubscriberInterface
{

    private IGetListCustomerService $getListCustomerService;
    private ILoggerService $loggerService;

    public function __construct(
        IGetListCustomerService $getListCustomerService,
        ILoggerService          $loggerService
    )
    {
        $this->getListCustomerService = $getListCustomerService;
        $this->loggerService = $loggerService;
    }

    public static function getSubscribedEvents()
    {
        return [
            GetListCustomerEvent::NAME => [
                ['onCallListCustomer', 10],
                ['onCallListCustomerLogger', -10]
            ]
        ];
    }

    public function onCallListCustomerLogger()
    {
        $this->loggerService->logMessage('Call for users list');
    }

    public function onCallListCustomer(GetListCustomerEvent $getListCustomerEvent): void
    {
        $customer = $this->getListCustomerService->getList();
        $getListCustomerEvent->setCustomers($customer);
    }
}