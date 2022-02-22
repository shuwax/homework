<?php


use App\Tools\Date\DateHandler;

use PHPUnit\Framework\TestCase;

class DateHandlerTest extends TestCase
{

    public function testGetCurrentDate() {
        $dateHandler = new DateHandler();
        $currentDate = $dateHandler->getCurrentDate();
        $this->assertGreaterThanOrEqual($currentDate, new DateTime());

    }
    public function testGetFormatDate() {
        $format = 'Y-m-d';
        $dateHandler = new DateHandler();
        $currentDate = $dateHandler->getCurrentDate();
        $dateObj  = new DateTime();
        $this->assertEquals($dateHandler->formatDate($currentDate, $format), $dateObj->format($format));
    }

    public function testAddToCurrentDateDays () {
        $format = 'Y-m-d';
        $dateHandler = new DateHandler();
        $currentDate = $dateHandler->getCurrentDate();
        $dateObj  = new DateTime();
        $this->assertEquals($dateHandler->formatDate($dateHandler->addToCurrentDateDays('-1'), $format), $dateObj->modify('-1 day')->format($format));
    }

}