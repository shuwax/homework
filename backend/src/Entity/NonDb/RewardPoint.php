<?php


namespace App\Entity\NonDb;

use Symfony\Component\Serializer\Annotation\Groups;

class RewardPoint
{

    /**
     * @Groups({"customer:show:rewardPoints"})
     */
    private int $rewardPoints = 0;

    private array $rewardPointsPerMonth = [];

    /**
     * @return int
     */
    public function getRewardPoints(): int
    {
        return $this->rewardPoints;
    }

    /**
     * @param int $rewardPoints
     */
    public function setRewardPoints(int $rewardPoints): void
    {
        $this->rewardPoints = $rewardPoints;
    }

    /**
     * @return array
     */
    public function getRewardPointsPerMonth(): array
    {
        return $this->rewardPointsPerMonth;
    }

    /**
     * @param array $rewardPointsPerMonth
     */
    public function setRewardPointsPerMonth(array $rewardPointsPerMonth): void
    {
        $this->rewardPointsPerMonth = $rewardPointsPerMonth;
    }


}