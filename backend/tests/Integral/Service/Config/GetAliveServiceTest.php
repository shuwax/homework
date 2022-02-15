<?php

namespace Service\Config;

use App\Service\Config\IGetAliveService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GetAliveServiceTest extends KernelTestCase
{
    public function testGetAliveService()
    {
        self::bootKernel();
        $container = static::getContainer();

        $getAliveService = $container->get(IGetAliveService::class);

        $this->assertEquals(["message" => "alive"], $getAliveService->getAlive());
    }

}