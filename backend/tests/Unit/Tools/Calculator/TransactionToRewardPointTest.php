<?php

use App\Tools\Calculator\RewardPoints\TransactionToRewardPoint;
use PHPUnit\Framework\TestCase;

class TransactionToRewardPointTest extends TestCase
{

    public function testCalculateRewardPointsOver220() {
        $transactionValue = 22000;
        $calculateRewardPoints = new TransactionToRewardPoint($transactionValue);
        $calculateRewardPoints->calculateRewardPoint();
        $this->assertEquals(41000, $calculateRewardPoints->getRewardPoints());
    }

    public function testCalculateRewardPointsOver100() {
        $transactionValue = 12000;
        $calculateRewardPoints = new TransactionToRewardPoint($transactionValue);
        $calculateRewardPoints->calculateRewardPoint();
        $this->assertEquals(11000, $calculateRewardPoints->getRewardPoints());
    }

    public function testCalculateRewardPointsEqual100() {
        $transactionValue = 10000;
        $calculateRewardPoints = new TransactionToRewardPoint($transactionValue);
        $calculateRewardPoints->calculateRewardPoint();
        $this->assertEquals(5000, $calculateRewardPoints->getRewardPoints());
    }

    public function testCalculateRewardPointsEqual50() {
        $transactionValue = 5000;
        $calculateRewardPoints = new TransactionToRewardPoint($transactionValue);
        $calculateRewardPoints->calculateRewardPoint();
        $this->assertEquals(0, $calculateRewardPoints->getRewardPoints());
    }

    public function testCalculateRewardPointsEqual0() {
        $transactionValue = 0;
        $calculateRewardPoints = new TransactionToRewardPoint($transactionValue);
        $calculateRewardPoints->calculateRewardPoint();
        $this->assertEquals(0, $calculateRewardPoints->getRewardPoints());
    }
}