<?php

namespace App\Service\Config;

use Psr\Log\LoggerInterface;

class GetAliveService implements IGetAliveService
{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return string[]
     */
    public function getAlive():array  {
        $this->logger->info('Application alive');
        return [
            'message' => 'alive'
        ];
    }
}