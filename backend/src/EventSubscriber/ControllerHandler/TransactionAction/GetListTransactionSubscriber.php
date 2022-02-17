<?php

namespace App\EventSubscriber\ControllerHandler\TransactionAction;

use App\Event\ControllerHandler\Transaction\GetListTransactionEvent;
use App\Service\Logger\ILoggerService;
use App\Service\Transaction\IGetListTransactionService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GetListTransactionSubscriber implements EventSubscriberInterface
{

    private IGetListTransactionService $getListTransactionService;
    private ILoggerService $loggerService;

    public function __construct(
        IGetListTransactionService $getListTransactionService,
        ILoggerService $loggerService
    )
    {
        $this->getListTransactionService = $getListTransactionService;
        $this->loggerService = $loggerService;
    }

    public static function getSubscribedEvents()
    {
       return [
           GetListTransactionEvent::NAME => [
               ['onCallGetListTransactions', 10],
               ['onCallGetListTransactionsLogger', -10]
           ]
       ];
    }

    public function onCallGetListTransactionsLogger(GetListTransactionEvent $getListTransactionEvent) {
        $this->loggerService->logMessage('Call  transaction list ');
    }

    public function onCallGetListTransactions (GetListTransactionEvent $getListTransactionEvent): void {
        $transactions = $this->getListTransactionService->getList();
        $getListTransactionEvent->setTransactions($transactions);
    }
}