<?php

namespace App\Http\Controllers;

use App\Services\IDeliveryService;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public $deliveryService;
    public function __construct(IDeliveryService $deliveryService)
    {
        $this->deliveryService=$deliveryService;
    }

    public function index()
    {
        $deliveries = $this->deliveryService->index();
        //dd($deliveries);
        return view('welcome')->with(['deliveries'=>$deliveries]);
    }
}
