<?php

namespace Tests\Feature;

use App\Models\Delivery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeliveryRoutesTest extends TestCase
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

    public function testUpdateRoutes()
    {
        $delivery = factory(Delivery::class)->create();

        $delivery_routes=[
            "data"=>[
                'delivery_id' => $delivery->id,
                'route_id' => 1,
                'position' => 1
            ]
        ];

        $this->json('patch', 'api/v1/routes', $delivery_routes)
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data'=>[],
                'code'=>Response::HTTP_OK,
                'message'=> 'delivery route is updated'
            ]);
    }
}




