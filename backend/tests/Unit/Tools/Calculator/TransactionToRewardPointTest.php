<?php

use App\Tools\Calculator\RewardPoints\TransactionToRewardPoint;
use PHPUnit\Framework\TestCase;

class TransactionToRewardPointTest extends TestCase
{

    public function testCalculateRewardPointsOver220() {
        $transactionValue = 220;
        $transactionRawValue = $transactionValue * 100;
        $calculateRewardPoints = new TransactionToRewardPoint($transactionRawValue);
        $calculateRewardPoints->calculateRewardPoint();
        $this->assertEquals(410, $calculateRewardPoints->getRewardPoints());
    }

    public function testCalculateRewardPointsOver123() {
        $transactionValue = 123.33;
        $transactionRawValue = $transactionValue * 100;
        $calculateRewardPoints = new TransactionToRewardPoint($transactionRawValue);
        $calculateRewardPoints->calculateRewardPoint();
        $this->assertEquals(119, $calculateRewardPoints->getRewardPoints());
    }

    public function testCalculateRewardPointsOver100() {
        $transactionValue = 120;
        $transactionRawValue = $transactionValue * 100;
        $calculateRewardPoints = new TransactionToRewardPoint($transactionRawValue);
        $calculateRewardPoints->calculateRewardPoint();
        $this->assertEquals(110, $calculateRewardPoints->getRewardPoints());
    }

    public function testCalculateRewardPointsEqual100() {
        $transactionValue = 100;
        $transactionRawValue = $transactionValue * 100;
        $calculateRewardPoints = new TransactionToRewardPoint($transactionRawValue);
        $calculateRewardPoints->calculateRewardPoint();
        $this->assertEquals(50, $calculateRewardPoints->getRewardPoints());
    }

    public function testCalculateRewardPointsEqual51() {
        $transactionValue = 51;
        $transactionRawValue = $transactionValue * 100;
        $calculateRewardPoints = new TransactionToRewardPoint($transactionRawValue);
        $calculateRewardPoints->calculateRewardPoint();
        $this->assertEquals(1, $calculateRewardPoints->getRewardPoints());
    }

    public function testCalculateRewardPointsEqual50() {
        $transactionValue = 50;
        $transactionRawValue = $transactionValue * 100;
        $calculateRewardPoints = new TransactionToRewardPoint($transactionRawValue);
        $calculateRewardPoints->calculateRewardPoint();
        $this->assertEquals(0, $calculateRewardPoints->getRewardPoints());
    }

    public function testCalculateRewardPointsEqual0() {
        $transactionRawValue = 0;
        $calculateRewardPoints = new TransactionToRewardPoint($transactionRawValue);
        $calculateRewardPoints->calculateRewardPoint();
        $this->assertEquals(0, $calculateRewardPoints->getRewardPoints());
    }
}