<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Api\V1\RouteStoreRequest;
use App\Http\Requests\Api\V1\RouteUpdateRequest;
use App\Services\IDeliveryService;
use App\Services\IRouteService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RouteAPIController extends BaseController
{
    public $deliveryService;
    public $routeService;
    public function __construct(IDeliveryService $deliveryService,
                                IRouteService $routeService)
    {
        $this->deliveryService = $deliveryService;
        $this->routeService = $routeService;
    }

    public function update(RouteUpdateRequest $request)
    {
        $this->routeService->update($request['data']);
        return $this->response([],'delivery route is updated',Response::HTTP_OK);
    }

    public function destroy(Request $request)
    {
        $route = $this->routeService->getRouteByDeliverId($request->all());
        if($route)
        {
            $this->routeService->delete($request->delivery_id);
            return $this->response([],'route is deleted',Response::HTTP_OK);
        }
        return $this->error('route not found',Response::HTTP_NOT_FOUND);
    }
}
