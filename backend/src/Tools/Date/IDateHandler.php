<?php

namespace App\Tools\Date;

interface IDateHandler {

    public function getCurrentDate() : \DateTime;
    public function formatDate(\DateTime $date, string $format) : string;
    public function addToCurrentDateDays (string $dayModifier = '0'): \DateTime;
}