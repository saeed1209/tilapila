<?php


namespace App\Http\Controllers;



class BaseController extends Controller
{
    public function response($data, string $message, $code)
    {
        return json_encode([
                'data'=>$data,
                'success'=>true,
                'message'=>$message,
                'code'=>$code
            ]);
    }
    public function error(string $message, $code)
    {
        return json_encode([
            'success'=>false,
            'message'=>$message,
            'code'=>$code
        ]);
    }
}
