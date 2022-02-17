<?php

namespace App\EventSubscriber\ControllerHandler\CustomerAction;

use App\Event\ControllerHandler\Customer\GetOneCustomerEvent;
use App\Service\Customer\IGetCustomerService;
use App\Service\Logger\ILoggerService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GetCustomerSubscriber implements EventSubscriberInterface
{

    private IGetCustomerService $getCustomerService;
    private ILoggerService $loggerService;

    public function __construct(
        IGetCustomerService $getCustomerService,
        ILoggerService      $loggerService
    )
    {
        $this->getCustomerService = $getCustomerService;
        $this->loggerService = $loggerService;
    }

    public static function getSubscribedEvents()
    {
        return [
            GetOneCustomerEvent::NAME => [
                ['onCallOneCustomer', 10],
                ['onCallOneCustomerLogger', -10]
            ]
        ];
    }

    public function onCallOneCustomerLogger(GetOneCustomerEvent $getOneCustomer)
    {
        $this->loggerService->logMessage('Call for user: ' . $getOneCustomer->getCustomerId());
    }

    public function onCallOneCustomer(GetOneCustomerEvent $getOneCustomer): void
    {
        $customer = $this->getCustomerService->get($getOneCustomer->getCustomerId());
        $getOneCustomer->setCustomer($customer);
    }
}