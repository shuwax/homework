<?php

namespace App\Service\Logger;

interface ILoggerService
{
    public function logMessage(string $message);
}