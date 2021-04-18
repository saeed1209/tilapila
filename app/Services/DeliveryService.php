<?php


namespace App\Services;

use App\Repositories\IDeliveryRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeliveryService implements IDeliveryService,IBaseService
{
    public $deliveryRepository;

    public function __construct(IDeliveryRepository $deliveryRepository)
    {
        $this->deliveryRepository = $deliveryRepository;
    }

    public function create($request)
    {
        return $this->deliveryRepository->create($request);
    }

    public function update($request,$id)
    {
        return $this->deliveryRepository->update($request,$id);
    }

    public function delete($id)
    {
        $this->deliveryRepository->delete($id);
    }

    public function index()
    {
        return $this->deliveryRepository->getDeliveriesWithRoute();
    }

    public function getDeliveryById($id)
    {
        $delivery =  $this->deliveryRepository->findDeliveryWithRouteByDeliveryId($id);

        /*if (!$delivery) {
           throw new \Exception('Delivery not found', 404);
        }*/
        return $delivery;
    }
}
