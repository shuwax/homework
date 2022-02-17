<?php

namespace App\EventSubscriber\ControllerHandler\TransactionAction;

use App\Event\ControllerHandler\Transaction\DeleteTransactionEvent;
use App\Service\Logger\ILoggerService;
use App\Service\Transaction\IDeleteTransactionService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DeleteTransactionSubscriber implements EventSubscriberInterface
{

    private IDeleteTransactionService $deleteTransactionService;
    private ILoggerService $loggerService;

    public function __construct(
        IDeleteTransactionService $deleteTransactionService,
        ILoggerService            $loggerService
    )
    {
        $this->deleteTransactionService = $deleteTransactionService;
        $this->loggerService = $loggerService;
    }

    public static function getSubscribedEvents()
    {
        return [
            DeleteTransactionEvent::NAME => [
                ['onCallDeleteTransactions', 10],
                ['onCallDeleteTransactionsLogger', -10]
            ]
        ];
    }

    public function onCallDeleteTransactionsLogger(DeleteTransactionEvent $deleteTransactionEvent)
    {
        $this->loggerService->logMessage('Call delete transaction id: ' . $deleteTransactionEvent->getTransactionId());
    }

    public function onCallDeleteTransactions(DeleteTransactionEvent $deleteTransactionEvent): void
    {
        $this->deleteTransactionService->delete($deleteTransactionEvent->getTransactionId());
    }
}