<?php

namespace App\EventSubscriber\ControllerHandler\TransactionAction;

use App\Event\ControllerHandler\Transaction\CreateTransactionEvent;
use App\Service\Logger\ILoggerService;
use App\Service\Transaction\IPostTransactionService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CreateTransactionSubscriber implements EventSubscriberInterface
{

    private IPostTransactionService $postTransactionService;
    private ILoggerService $loggerService;

    public function __construct(
        IPostTransactionService $postTransactionService,
        ILoggerService $loggerService
    )
    {
        $this->postTransactionService = $postTransactionService;
        $this->loggerService = $loggerService;
    }

    public static function getSubscribedEvents()
    {
       return [
           CreateTransactionEvent::NAME => [
               ['onCallCreateTransaction', 10],
               ['onCallCreateTransactionLogger', -10]
           ]
       ];
    }

    public function onCallCreateTransactionLogger(CreateTransactionEvent $createTransactionEvent) {
        $this->loggerService->logMessage('Call create transaction: '.$createTransactionEvent->getTransaction()->getId());
    }

    public function onCallCreateTransaction (CreateTransactionEvent $createTransactionEvent): void {
        $transaction = $this->postTransactionService->create($createTransactionEvent->getTransactionData());
        $createTransactionEvent->setTransaction($transaction);
    }
}