<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected function successResponse($data = [] , $message='')
    {
        $status =200;
        $response = [
            'success' => true,
            'status' => 200 ,
            'data' => $data,
            'message' => $message,
        ];

        return response()->json($response);
    }


    public function errorResponse($message='', $code , $data = [])
    {
        $response = [
            'success' => false,
            'status' =>$code,
            'message' => $message,
            'data' => $data,

        ];

        return response()->json($response , $code);
    }
}
