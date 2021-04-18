<?php


namespace App\Services;


interface IRouteService
{
    public function getRouteByDeliverId($request);
    public function update($request);
    public function delete($delivery_id);
}
