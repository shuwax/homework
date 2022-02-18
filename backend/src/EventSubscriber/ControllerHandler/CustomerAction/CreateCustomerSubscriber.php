<?php

namespace App\EventSubscriber\ControllerHandler\CustomerAction;

use App\Event\ControllerHandler\Customer\CreateCustomerEvent;
use App\Service\Customer\IPostCustomerService;
use App\Service\Logger\ILoggerService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CreateCustomerSubscriber implements EventSubscriberInterface
{

    private IPostCustomerService $postCustomerService;
    private ILoggerService $loggerService;

    public function __construct(
        IPostCustomerService $postCustomerService,
        ILoggerService       $loggerService
    )
    {
        $this->postCustomerService = $postCustomerService;
        $this->loggerService = $loggerService;
    }

    public static function getSubscribedEvents()
    {
        return [
            CreateCustomerEvent::NAME => [
                ['onCallCreateCustomer', 10],
                ['onCallCreateCustomerLogger', -10]
            ]
        ];
    }

    public function onCallCreateCustomerLogger(CreateCustomerEvent $createCustomerEvent)
    {
        $this->loggerService->logMessage('Call create user: ' . $createCustomerEvent->getCustomer()->getId());
    }

    public function onCallCreateCustomer(CreateCustomerEvent $createCustomerEvent): void
    {
        $customer = $this->postCustomerService->create($createCustomerEvent->getCustomerDTO());
        $createCustomerEvent->setCustomer($customer);
    }
}