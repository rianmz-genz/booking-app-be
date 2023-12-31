<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;

trait Helper
{
    public function basic_response($data, $message = 'Success', $code = 200, $status = true)
    {
        return response([
            'status' => $status,
            'message' => $message,
            'code' => $code,
            'data' => $data,
        ], $code);
    }
}
