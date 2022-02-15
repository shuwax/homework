<?php

namespace App\Tools\Math;

interface IMath
{
    /**
     * @param array $values
     * @return float
     */
    public function getAvg(array $values): float;

}