<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class RouteStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $route_id = $this->route_id;
        $position = $this->position;
        return [
            'route_id'=>'in:' . implode(',', [1,2,3,4,5]),
            'delivery_id'=>'required|unique:delivery_routes,delivery_id',
            'position'=>[
                'required',
                Rule::unique('delivery_routes')
                    ->where(function ($query)use($route_id,$position){
                    return $query->where('route_id',$route_id)
                            ->where('position',$position);
            })]
        ];
    }
}
