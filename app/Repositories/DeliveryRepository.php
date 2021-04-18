<?php


namespace App\Repositories;

use App\Models\Delivery;
use Illuminate\Support\Facades\DB;

class DeliveryRepository extends BaseRepository implements IDeliveryRepository
{
    public $delivery;
    public function __construct(Delivery $delivery)
    {
        $this->delivery = $delivery;
    }

    public function create($request)
    {
            return  $this->delivery->create($request);
    }

    public function update($request,$id)
    {
        $this->delivery->where('id',$id)->update($request);

    }

    public function delete($id)
    {
        DB::transaction(function() use($id){
            $this->delivery->where('id',$id)->delete();
            DB::table('delivery_routes')
                ->where('delivery_id',$id)->delete();
        });

    }

    public function getDeliveriesWithRoute()
    {
        return $this->delivery
            ->leftJoin('delivery_routes','delivery_id','=','deliveries.id')
            ->select('deliveries.*', 'route_id','position')
            ->orderBy('position','ASC')
            ->get();

    }

    public function findDeliveryWithRouteByDeliveryId($delivery_id)
    {
        return $this->delivery
                    ->leftJoin('delivery_routes','delivery_id','=','deliveries.id')
                    ->where('deliveries.id',$delivery_id)
                    ->select('deliveries.*', 'route_id')
                    ->first();
    }

}
