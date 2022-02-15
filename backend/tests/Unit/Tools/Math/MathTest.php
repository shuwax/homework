<?php


use App\Tools\Math\Math;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{

    public function testGetAvgFull() {
        $values = [2,2,2,2];
        $mathObj = new Math();
        $result = $mathObj->getAvg($values);
        $this->assertEquals($result, 2.0);
    }

    public function testGetAvgEmptyValues() {
        $values = [];
        $mathObj = new Math();
        $result = $mathObj->getAvg($values);
        $this->assertEquals($result, 0);
    }

    public function testGetAvgWrongValues() {
        $values = [[]];
        $mathObj = new Math();
        $result = $mathObj->getAvg($values);
        $this->assertEquals($result, 0);
    }
}