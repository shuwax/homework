<?php

namespace App\EventSubscriber\ControllerHandler\CustomerAction;

use App\Event\ControllerHandler\Customer\GetRewardPointsCustomerEvent;
use App\Service\Customer\IGetCustomerService;
use App\Service\Logger\ILoggerService;
use App\Service\RewardPoint\IGetRewardPointsService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GetRewardPointsCustomerSubscriber implements EventSubscriberInterface
{

    private IGetCustomerService $getCustomerService;
    private ILoggerService $loggerService;
    private IGetRewardPointsService $getRewardPointsService;

    public function __construct(
        IGetCustomerService $getCustomerService,
        IGetRewardPointsService $getRewardPointsService,
        ILoggerService      $loggerService
    )
    {
        $this->getRewardPointsService = $getRewardPointsService;
        $this->getCustomerService = $getCustomerService;
        $this->loggerService = $loggerService;
    }

    public static function getSubscribedEvents()
    {
        return [
            GetRewardPointsCustomerEvent::NAME => [
                ['onCallRewardPointsCustomer', 10],
                ['onCallRewardPointsCustomerLogger', -10]
            ]
        ];
    }

    public function onCallRewardPointsCustomerLogger(GetRewardPointsCustomerEvent $getRewardPointsCustomerEvent)
    {
        $this->loggerService->logMessage('Call for user: ' . $getRewardPointsCustomerEvent->getCustomerId(). ' reward points');
    }

    public function onCallRewardPointsCustomer(GetRewardPointsCustomerEvent $getRewardPointsCustomerEvent): void
    {
        $customer = $this->getCustomerService->get($getRewardPointsCustomerEvent->getCustomerId());
        $getRewardPointsCustomerEvent->setRewardPoint($this->getRewardPointsService->calculateRewardPointsCustomer($customer));
    }
}