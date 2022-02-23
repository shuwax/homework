<?php

namespace App\EventSubscriber\ControllerHandler\TransactionAction;

use App\Event\ControllerHandler\Transaction\UpdateTransactionEvent;
use App\Service\Logger\ILoggerService;
use App\Service\Transaction\IPutTransactionService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UpdateTransactionSubscriber implements EventSubscriberInterface
{

    private IPutTransactionService $putTransactionService;
    private ILoggerService $loggerService;

    public function __construct(
        IPutTransactionService $putTransactionService,
        ILoggerService         $loggerService
    )
    {
        $this->putTransactionService = $putTransactionService;
        $this->loggerService = $loggerService;
    }

    public static function getSubscribedEvents()
    {
        return [
            UpdateTransactionEvent::NAME => [
                ['onCallUpdateTransactions', 10],
                ['onCallUpdateTransactionsLogger', -10]
            ]
        ];
    }

    public function onCallUpdateTransactionsLogger(UpdateTransactionEvent $updateTransactionEvent)
    {
        $this->loggerService->logMessage('Call transaction update id: ' . $updateTransactionEvent->getTransaction()->getId());
    }

    public function onCallUpdateTransactions(UpdateTransactionEvent $updateTransactionEvent): void
    {
        $transaction = $this->putTransactionService->put($updateTransactionEvent->getTransactionId(), $updateTransactionEvent->getTransactionDTO());
        $updateTransactionEvent->setTransaction($transaction);
    }
}