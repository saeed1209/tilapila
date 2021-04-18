<?php

namespace Tests\Feature;

use App\Models\Delivery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;



class DeliveryTest extends TestCase
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
    public function testDeliveryListedSuccessfully()
    {

        $delivery = factory(Delivery::class)->create();


        $this->json('GET', 'api/v1/deliveries', ['Accept' => 'application/json'])
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                "data" => [
                    [
                        "id" => $delivery->id,
                        "title"=> $delivery->title,
                        "date" => Carbon::parse($delivery->date)->format('Y-m-d H:i:s'),
                        "route"=>[
                            "route_id"=> null,
                            "position"=> null
                        ]
                    ],
                ],
                "message"=>'retrieve all deliveries successfully',
                "success"=>true,
                "code"=>Response::HTTP_OK
            ])->assertJsonStructure([
                "data" => [
                    [
                        "id" ,
                        "title",
                        "date" ,
                        "route"=>[
                            "route_id",
                            "position"
                        ]
                    ],
                ],
                "message",
                "success",
                "code"
            ]);
    }
    public function testDeliveryShouldBeCreatedSuccessfully()
    {
        $delivery = [
            "title" => "delivery for due de soliel",
            "date"=> "2021-04-12 12:20:22"
        ];

        $this->json('POST', 'api/v1/deliveries', $delivery)
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                "success"=>true,
                "message" => 'delivery created',
                "code"=>Response::HTTP_CREATED,
                "data" => [
                    "id"=>1,
                    "title"=>$delivery['title'] ,
                    "date"=>$delivery['date'] ,
                ],

            ])
            ->assertJsonStructure([
                "success",
                "message",
                "code",
                "data" => [
                    "id",
                    "title" ,
                    "date" ,
                ],

            ]);


        $this->assertDatabaseHas('deliveries', $delivery);
    }
    public function testDeliveryIsDestroyed() {


        $deliveryData = [
            'title' => $this->faker->title,
            'date' => $this->faker->date(),
        ];

        $delivery = Delivery::create($deliveryData);
        $this->json('delete', "api/v1/deliveries/$delivery->id")
            ->assertJson([
                "success"=>true,
                "message" => 'delivery deleted',
                "code"=>Response::HTTP_OK,
                "data" => [],

            ]);
        $this->assertSoftDeleted('deliveries', $deliveryData);
    }
    public function testStoreDeliveryWithMissingData() {

        $delivery = [
            //'title' => $this->faker->title,
            'date'  => $this->faker->date()
        ];
        $this->json('post', 'api/v1/deliveries/', $delivery)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => "The given data was invalid.",
                "errors" => [
                    "title"=> [
                        "The title field is required."
                    ]
                ]
            ]);
    }
    public function testDestroyForMissingDelivery() {

        $this->json('delete', "api/v1/deliveries/0")
                ->assertJson([
                    "success"=>false,
                    "message" => 'delivery not found',
                    "code"=>Response::HTTP_NOT_FOUND,
                ]);
    }
}
