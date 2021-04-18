<?php


namespace App\Services;


interface IDeliveryService
{
    public function getDeliveryById($id);
    public function index();
    public function update($request,$id);
    public function delete($id);
}
