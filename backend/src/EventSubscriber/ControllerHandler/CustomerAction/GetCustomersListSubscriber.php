<?php

namespace App\EventSubscriber\ControllerHandler\CustomerAction;

use App\Event\ControllerHandler\Customer\GetListCustomerEvent;
use App\Service\Customer\ICalculateRewardPointsListCustomerService;
use App\Service\Customer\IGetListCustomerService;
use App\Service\Logger\ILoggerService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GetCustomersListSubscriber implements EventSubscriberInterface
{

    private IGetListCustomerService $getListCustomerService;
    private ICalculateRewardPointsListCustomerService $calculateRewardPointsListCustomerService;
    private ILoggerService $loggerService;

    public function __construct(
        IGetListCustomerService                   $getListCustomerService,
        ICalculateRewardPointsListCustomerService $calculateRewardPointsListCustomerService,
        ILoggerService                            $loggerService
    )
    {
        $this->calculateRewardPointsListCustomerService = $calculateRewardPointsListCustomerService;
        $this->getListCustomerService = $getListCustomerService;
        $this->loggerService = $loggerService;
    }

    public static function getSubscribedEvents()
    {
        return [
            GetListCustomerEvent::NAME => [
                ['onCallListCustomer', 10],
                ['onCallListCustomerCalculateRewardPoints', 0],
                ['onCallListCustomerLogger', -10]
            ]
        ];
    }

    public function onCallListCustomerLogger()
    {
        $this->loggerService->logMessage('Call for users list');
    }

    public function onCallListCustomerCalculateRewardPoints(GetListCustomerEvent $getListCustomerEvent)
    {
        $customers = $this->calculateRewardPointsListCustomerService->calculateRewardPointsListCustomers($getListCustomerEvent->getCustomers());
        $getListCustomerEvent->setCustomers($customers);
     }

    public function onCallListCustomer(GetListCustomerEvent $getListCustomerEvent): void
    {
        $customers = $this->getListCustomerService->getList();
        $getListCustomerEvent->setCustomers($customers);
    }
}