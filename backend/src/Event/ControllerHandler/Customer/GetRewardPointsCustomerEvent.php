<?php

namespace App\Event\ControllerHandler\Customer;

use App\Entity\NonDb\RewardPoint;
use Symfony\Contracts\EventDispatcher\Event;


class GetRewardPointsCustomerEvent extends Event
{

    public const NAME = 'controller.action.customer.getRewardPointsCustomer';

    private ?RewardPoint $rewardPoint = null;

    private int $customerId;

    public function __construct(int $customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @return RewardPoint|null
     */
    public function getRewardPoint(): ?RewardPoint
    {
        return $this->rewardPoint;
    }

    /**
     * @param RewardPoint|null $rewardPoint
     */
    public function setRewardPoint(?RewardPoint $rewardPoint): void
    {
        $this->rewardPoint = $rewardPoint;
    }

}