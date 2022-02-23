<?php

namespace App\EventSubscriber\ControllerHandler\TransactionAction;

use App\Event\ControllerHandler\Transaction\GetTransactionByCustomerEvent;
use App\Service\Customer\IGetCustomerService;
use App\Service\Logger\ILoggerService;
use App\Service\Transaction\IGetListTransactionService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GeTransactionsByCustomerSubscriber implements EventSubscriberInterface
{

    private IGetListTransactionService $getListTransactionService;
    private IGetCustomerService $getCustomerService;
    private ILoggerService $loggerService;

    public function __construct(
        IGetListTransactionService $getListTransactionService,
        IGetCustomerService $getCustomerService,
        ILoggerService             $loggerService
    )
    {
        $this->getCustomerService = $getCustomerService;
        $this->getListTransactionService = $getListTransactionService;
        $this->loggerService = $loggerService;
    }

    public static function getSubscribedEvents()
    {
        return [
            GetTransactionByCustomerEvent::NAME_PERIOD => [
                ['onCallGetListPeriodTransactions', 10],
                ['onCallGetListTransactionsLogger', -10]
            ],
            GetTransactionByCustomerEvent::NAME => [
                ['onCallGetListTransactions', 10],
                ['onCallGetListTransactionsLogger', -10]
            ],
        ];
    }

    public function onCallGetListTransactionsLogger()
    {
        $this->loggerService->logMessage('Call  transaction list ');
    }

    public function onCallGetListPeriodTransactions(GetTransactionByCustomerEvent $getTransactionByCustomerEvent): void
    {
        $customer = $this->getCustomerService->get($getTransactionByCustomerEvent->getCustomerId());
        $transactions = $this->getListTransactionService->getListPeriodTimeByCustomer($customer);
        $getTransactionByCustomerEvent->setTransactions($transactions);
    }

    public function onCallGetListTransactions(GetTransactionByCustomerEvent $getTransactionByCustomerEvent): void
    {
        $customer = $this->getCustomerService->get($getTransactionByCustomerEvent->getCustomerId());
        $transactions = $this->getListTransactionService->getListByCustomer($customer);
        $getTransactionByCustomerEvent->setTransactions($transactions);
    }
}