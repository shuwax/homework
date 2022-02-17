<?php

namespace App\EventSubscriber\ControllerHandler\CustomerAction;

use App\Event\ControllerHandler\Customer\DeleteCustomerEvent;
use App\Service\Customer\IDeleteCustomerService;
use App\Service\Logger\ILoggerService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DeleteCustomerSubscriber implements EventSubscriberInterface
{

    private IDeleteCustomerService $deleteCustomerService;
    private ILoggerService $loggerService;

    public function __construct(
        IDeleteCustomerService $deleteCustomerService,
        ILoggerService         $loggerService
    )
    {
        $this->deleteCustomerService = $deleteCustomerService;
        $this->loggerService = $loggerService;
    }

    public static function getSubscribedEvents()
    {
        return [
            DeleteCustomerEvent::NAME => [
                ['onCallDeleteCustomer', 10],
                ['onCallDeleteCustomerLogger', -10]
            ]
        ];
    }

    public function onCallDeleteCustomerLogger(DeleteCustomerEvent $deleteCustomerEvent)
    {
        $this->loggerService->logMessage('Call delete user: ' . $deleteCustomerEvent->getCustomerId());
    }

    public function onCallDeleteCustomer(DeleteCustomerEvent $deleteCustomerEvent): void
    {
        $this->deleteCustomerService->delete($deleteCustomerEvent->getCustomerId());
    }
}