<?php

namespace App\Service\Config;


interface IGetAliveService
{
    /**
     * @return array
     */
    public function getAlive(): array;
}