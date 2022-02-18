<?php

namespace App\EventSubscriber\ControllerHandler\CustomerAction;

use App\Event\ControllerHandler\Customer\UpdateCustomerEvent;
use App\Service\Customer\IPutCustomerService;
use App\Service\Logger\ILoggerService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UpdateCustomerSubscriber implements EventSubscriberInterface
{

    private IPutCustomerService $putCustomerService;
    private ILoggerService $loggerService;

    public function __construct(
        IPutCustomerService $putCustomerService,
        ILoggerService      $loggerService
    )
    {
        $this->putCustomerService = $putCustomerService;
        $this->loggerService = $loggerService;
    }

    public static function getSubscribedEvents()
    {
        return [
            UpdateCustomerEvent::NAME => [
                ['onCallUpdateCustomer', 10],
                ['onCallUpdateCustomerLogger', -10]
            ]
        ];
    }

    public function onCallUpdateCustomerLogger(UpdateCustomerEvent $updateCustomerEvent)
    {
        $this->loggerService->logMessage('Call update user: ' . $updateCustomerEvent->getCustomer()->getId());
    }

    public function onCallUpdateCustomer(UpdateCustomerEvent $updateCustomerEvent): void
    {
        $customer = $this->putCustomerService->put($updateCustomerEvent->getCustomerId(), $updateCustomerEvent->getCustomerDTO());
        $updateCustomerEvent->setCustomer($customer);
    }
}