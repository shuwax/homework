<?php

namespace App\EventSubscriber\ControllerHandler\TransactionAction;

use App\Event\ControllerHandler\Transaction\GetOneTransactionEvent;
use App\Service\Logger\ILoggerService;
use App\Service\Transaction\IGetOneTransactionService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GetOneTransactionSubscriber implements EventSubscriberInterface
{

    private IGetOneTransactionService $getOneTransactionService;
    private ILoggerService $loggerService;

    public function __construct(
        IGetOneTransactionService $getOneTransactionService,
        ILoggerService            $loggerService
    )
    {
        $this->getOneTransactionService = $getOneTransactionService;
        $this->loggerService = $loggerService;
    }

    public static function getSubscribedEvents()
    {
        return [
            GetOneTransactionEvent::NAME => [
                ['onCallGetOneTransactions', 10],
                ['onCallGetOneTransactionsLogger', -10]
            ]
        ];
    }

    public function onCallGetOneTransactionsLogger(GetOneTransactionEvent $getOneTransactionEvent)
    {
        $this->loggerService->logMessage('Call transaction id: ' . $getOneTransactionEvent->getTransaction()->getId());
    }

    public function onCallGetOneTransactions(GetOneTransactionEvent $getOneTransactionEvent): void
    {
        $transaction = $this->getOneTransactionService->getOne($getOneTransactionEvent->getTransactionId());
        $getOneTransactionEvent->setTransaction($transaction);
    }
}