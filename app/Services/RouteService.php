<?php


namespace App\Services;


use App\Repositories\IRouteRepository;
use Illuminate\Support\Facades\DB;

class RouteService implements IBaseService,IRouteService
{
    public $routeRepository;
    public function __construct(IRouteRepository  $routeRepository)
    {
        $this->routeRepository=$routeRepository;
    }

    public function create($request)
    {
        return $this->routeRepository->create($request);
    }

    public function update($request)
    {
        $this->routeRepository->update($request);

    }
    public function delete($delivery_id){

        $this->routeRepository->delete($delivery_id);
    }
    public function getRouteByDeliverId($request)
    {
        return $this->routeRepository->getRouteByDeliverId($request);
    }
}
