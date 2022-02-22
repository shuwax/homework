<?php

use App\Entity\NonDb\RewardPoint;
use PHPUnit\Framework\TestCase;

class RewardPointTest extends TestCase
{
    public function testEntity() {
        $rewardPoint = new RewardPoint();
        $rewardPoint->setRewardPoints(120);
        $rewardPoint->setRewardPointsPerMonth(['1' => 0]);
        $this->assertEquals(120, $rewardPoint->getRewardPoints());
        $this->assertEquals(['1' => 0], $rewardPoint->getRewardPointsPerMonth());
    }
}