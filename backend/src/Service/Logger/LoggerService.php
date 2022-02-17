<?php

namespace App\Service\Logger;

use Psr\Log\LoggerInterface;

class LoggerService implements ILoggerService
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function logMessage(string $message)
    {
        $this->logger->info($message);
    }
}