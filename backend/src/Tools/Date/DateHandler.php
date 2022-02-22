<?php


namespace App\Tools\Date;


class DateHandler implements IDateHandler
{

    public function getCurrentDate() : \DateTime {
        return new \DateTime();
    }

    public function formatDate(\DateTime $date, string $format) : string {
        return $date->format($format);
    }

    public function addToCurrentDateDays (string $dayModifier = '0'): \DateTime {
        $datetime = $this->getCurrentDate();
        $datetime->modify($dayModifier.' day');
        return $datetime;
    }
}