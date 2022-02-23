<?php

use App\Event\ControllerHandler\Transaction\DeleteTransactionEvent;
use PHPUnit\Framework\TestCase;

class DeleteTransactionEventTest extends TestCase
{
    public function testEventSetup()
    {
        $translationId = 1;

        $deleteTranslationEvent = new DeleteTransactionEvent($translationId);

        $this->assertEquals($translationId, $deleteTranslationEvent->getTransactionId());

        $this->assertEquals('controller.action.transaction.deleteTransaction', DeleteTransactionEvent::NAME);

    }
}