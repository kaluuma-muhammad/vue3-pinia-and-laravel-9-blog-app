<?php
namespace App\Traits;

trait returnmessages
{

    public function returnsuccess($data, $msg){
        $erydata = $data;
        return response()->json([
            'res' => $data,
            'msg' => $msg,
            'status' => 200
        ], 200);
    }


    public function returnwarning($data, $msg){
        return response()->json([
            'res' => $data,
            'msg' => $msg,
            'status' => 201
        ], 201);
    }


    public function returnerrormsg($msg){
        return response()->json([
            'msg' => $msg,
            'status' => 401
        ], 401);
    }


    public function returnerror(){
        return response()->json([
            'msg' => 'Something has Happen ',
            'status' => 401
        ], 401);
    }
}
