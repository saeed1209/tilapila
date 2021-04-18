<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveries = factory(\App\Models\Delivery::class, 10)->create();
        $deliveries->each(function($delivery) {
            DB::table('delivery_routes')->insert([
                'delivery_id' => $delivery->id,
                'route_id' => rand(1, 5),
                'position' => rand(1, 10)
            ]);
        });
    }
}
