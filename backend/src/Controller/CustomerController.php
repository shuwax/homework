<?php

namespace App\Controller;

use App\DTO\CustomerDTO;
use App\Event\ControllerHandler\Customer\CreateCustomerEvent;
use App\Event\ControllerHandler\Customer\DeleteCustomerEvent;
use App\Event\ControllerHandler\Customer\GetListCustomerEvent;
use App\Event\ControllerHandler\Customer\GetOneCustomerEvent;
use App\Event\ControllerHandler\Customer\GetRewardPointsCustomerEvent;
use App\Event\ControllerHandler\Customer\UpdateCustomerEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

class CustomerController extends AbstractApiController
{
    /**
     * @OA\Tag(name="Customers")
     * @OA\Response(
     *     response=201,
     *     description="Create customer"
     * )
     * @ParamConverter("customerDTO", converter="fos_rest.request_body")
     * @Route("/customers", name="customer_post", methods="POST" )
     */
    public function post(
        SerializerInterface              $serializer,
        EventDispatcherInterface         $dispatcher,
        CustomerDTO                      $customerDTO,
        ConstraintViolationListInterface $validationErrors
    ): Response
    {
        if ($validationErrors->count() > 0) {
            return $this->responseBadRequest($validationErrors);
        }
        $createCustomerEvent = new CreateCustomerEvent($customerDTO);
        $dispatcher->dispatch($createCustomerEvent, CreateCustomerEvent::NAME);

        return $this->responseCREATED($this->serializer($serializer, $createCustomerEvent->getCustomer(), ['customer:post']));
    }

    /**
     * @OA\Tag(name="Customers")
     * @OA\Response(
     *     response=200,
     *     description="List customer"
     * )
     * @Route("/customers", name="customers_get", methods="GET" )
     */
    public function getList(SerializerInterface $serializer, EventDispatcherInterface $dispatcher): Response
    {
        $getListCustomerEvent = new GetListCustomerEvent();
        $dispatcher->dispatch($getListCustomerEvent, GetListCustomerEvent::NAME);
        return $this->responseOK($this->serializer($serializer, $getListCustomerEvent->getCustomers(), ['customer:list']));
    }



    /**
     * @OA\Tag(name="Customers")
     * @OA\Response(
     *     response=200,
     *     description="Customer reward points"
     * )
     * @Route("/customers/{customerId}/reward-points", name="customer_reawrd_points_get", methods="GET" )
     */
    public function getRewardPoints(SerializerInterface $serializer, EventDispatcherInterface $dispatcher, $customerId): Response
    {
        $getRewardPointsCustomerEvent = new GetRewardPointsCustomerEvent($customerId);
        $dispatcher->dispatch($getRewardPointsCustomerEvent, GetRewardPointsCustomerEvent::NAME);
        return $this->responseOK($this->serializer($serializer, $getRewardPointsCustomerEvent->getRewardPoint(), ['customer:show:rewardPoints']));
    }


    /**
     * @OA\Tag(name="Customers")
     * @OA\Response(
     *     response=200,
     *     description="Customer"
     * )
     * @Route("/customers/{customerId}", name="customer_get", methods="GET" )
     */
    public function getOne(SerializerInterface $serializer, EventDispatcherInterface $dispatcher, $customerId): Response
    {
        $getOneCustomerEvent = new GetOneCustomerEvent($customerId);
        $dispatcher->dispatch($getOneCustomerEvent, GetOneCustomerEvent::NAME);
        return $this->responseOK($this->serializer($serializer, $getOneCustomerEvent->getCustomer(), ['customer:show']));
    }


    /**
     * @OA\Tag(name="Customers")
     * @OA\Response(
     *     response=200,
     *     description="Update Customer"
     * )
     * @ParamConverter("customerDTO", converter="fos_rest.request_body")
     * @Route("/customers/{customerId}", name="customer_put", methods="PUT" )
     */
    public function put(
        SerializerInterface              $serializer,
        EventDispatcherInterface         $dispatcher,
        int                              $customerId,
        CustomerDTO                      $customerDTO,
        ConstraintViolationListInterface $validationErrors
    ): Response
    {
        if ($validationErrors->count() > 0) {
            return $this->responseBadRequest($validationErrors);
        }
        $updateCustomerEvent = new UpdateCustomerEvent($customerDTO, $customerId);
        $dispatcher->dispatch($updateCustomerEvent, UpdateCustomerEvent::NAME);
        return $this->responseOK($this->serializer($serializer, $updateCustomerEvent->getCustomer(), ['customer:put']));
    }

    /**
     * @OA\Tag(name="Customers")
     * @OA\Response(
     *     response=204,
     *     description="Delete Customer"
     * )
     * @Route("/customers/{customerId}", name="customer_delete", methods="DELETE" )
     */
    public function delete(EventDispatcherInterface $dispatcher, int $customerId): Response
    {
        $deleteCustomerEvent = new DeleteCustomerEvent($customerId);
        $dispatcher->dispatch($deleteCustomerEvent, DeleteCustomerEvent::NAME);
        return $this->responseNoContent();
    }
}
