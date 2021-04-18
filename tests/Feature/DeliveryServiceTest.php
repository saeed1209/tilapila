<?php

namespace Tests\Feature;

use App\Models\Delivery;
use App\Repositories\DeliveryRepository;
use App\Services\DeliveryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeliveryServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testDeliveryServiceCreateMethod()
    {
        $delivery = factory(Delivery::class)->create();

        $deliveryRepository = $this->mock(DeliveryRepository::class,function ($mock) use($delivery){
            $mock->shouldReceive('create')
                ->andReturn($delivery);
        });
        $service = new DeliveryService($deliveryRepository);
        $response =  $service->create([
            'title'=>$delivery->title,
            'date'=>$delivery->date
        ]);

        $this->assertEquals($response,$delivery);
    }

    public function testDeliveryServiceDeleteMethod()
    {
        $delivery = factory(Delivery::class)->create();

        $deliveryRepository = $this->mock(DeliveryRepository::class,function ($mock) use($delivery){
            $mock->shouldReceive('delete',$delivery->id)
                ->andReturn();
        });
        $service = new DeliveryService($deliveryRepository);
        $response =  $service->delete($delivery->id);

        $this->assertNull($response);
    }
}
