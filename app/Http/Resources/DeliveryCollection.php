<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DeliveryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function toArray($request)
    {
            return  $this->collection->map(function ($delivery){
                return [
                    'id'=>$delivery->id,
                    'title'=>$delivery->title,
                    'route'=>[
                        'route_id'=>$delivery->route_id,
                        'position'=>$delivery->position,
                    ],
                    'date'=>Carbon::parse($delivery->date)->format('Y-m-d H:i:s'),
                    ];
            });
    }
}
