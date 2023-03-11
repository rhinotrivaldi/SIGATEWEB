<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Token;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class HardwareController extends Controller
{
    public function all(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'number_plate' => 'required',
            'token' => 'required',
        ]);

        $data = Token::where('token', $request->token)->get();
        if ($data->isEmpty()) {
            return response()->json([
                'message' => 'Invalid Token'
            ], 401);
        }
        
        $data = Vehicle::where('number_plate', $request->number_plate)->get();
        if ($data->isEmpty()) {
            return response()->json([
                'message' => 'Number Plate Not Found'
            ], 404);
        }

        if ($request->status == 'in') {
            dd('silahkan masuk');
        }
        dd('silahkan keluar');

    }
}
