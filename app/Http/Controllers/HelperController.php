<?php


namespace App\Http\Controllers;


trait HelperController
{

    protected function resolve(string $operation, $data)
    {
        return response()->json(['status' => true, 'operation' => $operation, 'data' => $data]);
    }

    protected function reject(string $operation, $data = null)
    {
        return response()->json(['status' => false, 'operation' => $operation, 'data' => $data]);
    }
}
