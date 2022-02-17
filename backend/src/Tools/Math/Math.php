<?php

namespace App\Tools\Math;

class Math implements IMath
{
    /**
     * @param array $values
     * @return float
     */
    public function getAvg(array $values): float
    {
        $sum = array_sum($values);
        $count = count($values);
        return $count === 0 ? 0 : (float)$sum / $count;
    }
}