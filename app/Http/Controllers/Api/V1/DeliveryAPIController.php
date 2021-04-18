<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Api\V1\DeliveryStoreRequest;
use App\Http\Requests\Api\V1\DeliveryUpdateRequest;
use App\Http\Resources\DeliveryCollection;
use App\Http\Resources\DeliveryResource;
use App\Services\IDeliveryService;
use Symfony\Component\HttpFoundation\Response;

class DeliveryAPIController extends BaseController
{
    public $deliveryService;
    public function __construct(IDeliveryService $deliveryService)
    {
        $this->deliveryService=$deliveryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return false|\Illuminate\Http\Response|string
     */
    public function index()
    {
            $deliveries = $this->deliveryService->index();

            $deliveries = new DeliveryCollection($deliveries);

            return $this->response($deliveries,'retrieve all deliveries successfully', Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return false|\Illuminate\Http\Response|string
     */
    public function store(DeliveryStoreRequest $request)
    {
        $delivery = $this->deliveryService->create($request->all());
        $delivery = new DeliveryResource($delivery);
        return $this->response($delivery,'delivery created', Response::HTTP_CREATED);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return false|\Illuminate\Http\Response|string
     */
    public function update(DeliveryUpdateRequest $request, $id)
    {
        $delivery = $this->deliveryService->getDeliveryById($id);
        if($delivery) {
            $this->deliveryService->update($request->all(), $id);
            return $this->response([], 'delivery created', Response::HTTP_OK);
        }
        return $this->error('delivery not found',Response::HTTP_NOT_FOUND);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return false|\Illuminate\Http\Response|string
     */
    public function destroy($id)
    {
        $delivery = $this->deliveryService->getDeliveryById($id);
        if($delivery)
        {
            $this->deliveryService->delete($id);
            return $this->response([],'delivery deleted',Response::HTTP_OK);
        }
        return $this->error('delivery not found',Response::HTTP_NOT_FOUND);

    }
}
