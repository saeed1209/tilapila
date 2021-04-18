<?php


namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class RouteRepository extends BaseRepository implements IRouteRepository
{


    public function create($request)
    {
        return DB::table('delivery_routes')->updateOrInsert($request);

    }

    public function update($request)
    {

        DB::transaction(function()use($request){
            foreach($request as $value){
                if(isset($value['route_id'])){
                    $this->delete($value['delivery_id']);
                    DB::table('delivery_routes')->updateOrInsert([
                        'delivery_id'=>$value['delivery_id'],
                        'route_id'=>$value['route_id'],
                        'position'=>$value['position']
                    ]);
                }

            }
        });
    }

    public function delete($delivery_id)
    {
        DB::table('delivery_routes')
            ->where('delivery_id',$delivery_id)
            ->delete();
    }
    public function getRouteByDeliverId($request)
    {
        return DB::table('delivery_routes')
            ->where('delivery_id',$request['delivery_id'])
            ->first();
    }
}
