<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;

trait Helper
{
    public function success_response($data, $message = 'Success', $code = 200)
    {
        return response([
            'status' => true,
            'message' => $message,
            'code' => $code,
            'data' => $data,
        ], $code);
    }

    public function error_response($message, $code = 400, $data = null)
    {
        return response([
            'status' => false,
            'message' => $message,
            'code' => $code,
            'data' => $data,
        ], $code);
    }
}
