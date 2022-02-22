<?php

namespace App\EventSubscriber\ControllerHandler\TransactionAction;

use App\Event\ControllerHandler\Transaction\GetListTransactionEvent;
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
            GetTransactionByCustomerEvent::NAME => [
                ['onCallGetListTransactions', 10],
                ['onCallGetListTransactionsLogger', -10]
            ]
        ];
    }

    public function onCallGetListTransactionsLogger()
    {
        $this->loggerService->logMessage('Call  transaction list ');
    }

    public function onCallGetListTransactions(GetTransactionByCustomerEvent $getTransactionByCustomerEvent): void
    {
        $customer = $this->getCustomerService->get($getTransactionByCustomerEvent->getCustomerId());
        $transactions = $this->getListTransactionService->getListPeriodTime($customer);
        $getTransactionByCustomerEvent->setTransactions($transactions);
    }
}