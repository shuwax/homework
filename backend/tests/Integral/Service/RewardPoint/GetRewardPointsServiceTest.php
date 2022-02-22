<?php

namespace Service\RewardPoint;

use App\DTO\CustomerDTO;
use App\DTO\TransactionDTO;
use App\Entity\Customer;
use App\Entity\NonDb\RewardPoint;
use App\Service\Customer\IGetCustomerService;
use App\Service\Customer\IPostCustomerService;
use App\Service\RewardPoint\IGetRewardPointsService;
use App\Service\Transaction\IPostTransactionService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetRewardPointsServiceTest extends KernelTestCase
{

    public function testGetCustomerServiceFail()
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->expectException(NotFoundHttpException::class);
        $getService = $container->get(IGetCustomerService::class);
        $getService->get(-1);
    }

    public function testGetCustomerService()
    {
        self::bootKernel();
        $container = static::getContainer();
//        Create Customer
        $postService = $container->get(IPostCustomerService::class);
        $transactionPostService = $container->get(IPostTransactionService::class);
        $customerRewardPointsGetService = $container->get(IGetRewardPointsService::class);
        $getService = $container->get(IGetCustomerService::class);

        $customer = [
            'name' => 'Jan Kowalski'
        ];
        $customerDTO = new CustomerDTO($customer['name']);

        /** @var Customer $customer */
        $customer = $postService->create($customerDTO);


        /** @var Customer $serviceResult */
        $serviceResult = $getService->get($customer->getId());

        $transactionData = [
            'value' => 120,
            'customerId' => $customer->getId(),
            'transactionDate' => '2021-01-01'
        ];
        $transactionDTO = new TransactionDTO($transactionData['value'], $transactionData['customerId'], $transactionData['transactionDate']);
        $transactionDTO->setCustomer($customer);
        $transactionPostService->create($transactionDTO);

        $currentDate =  new \DateTime();
        $transactionData = [
            'value' => 120,
            'customerId' => $customer->getId(),
            'transactionDate' => $currentDate->format('Y-m-d')
        ];
        $transactionDTO = new TransactionDTO($transactionData['value'], $transactionData['customerId'], $transactionData['transactionDate']);
        $transactionDTO->setCustomer($customer);
        $transactionPostService->create($transactionDTO);

        /** @var Customer $customer */
        $customer = $getService->get($customer->getId());

        /** @var RewardPoint $rewardPoint */
        $rewardPoint = $customerRewardPointsGetService->calculateRewardPointsCustomer($customer);

        $this->assertEquals($customer->getId(), $serviceResult->getId());
        $this->assertEquals(110, $rewardPoint->getRewardPoints());
    }


}