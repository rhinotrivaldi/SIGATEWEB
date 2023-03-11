<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Token;
use App\Models\Vehicle;
use App\Models\VehicleLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HardwareController extends Controller
{
    public function all(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'number_plate' => 'required',
            'token' => 'required',
        ]);

        $token = Token::where('token', $request->token)->get();
        if ($token->isEmpty()) {
            return response()->json([
                'message' => 'Invalid Token'
            ], 401);
        }
        
        $plate = Vehicle::where('number_plate', $request->number_plate)->get();
        if ($plate->isEmpty()) {
            return response()->json([
                'message' => 'Number Plate Not Found'
            ], 404);
        }
        
        if ($request->status == 'in') {
            foreach ($plate as $item) {
                if ($item->status != 'out') {
                    return response()->json([
                        'message' => 'Vehicle position is In'
                    ], 404);
                }
            }
            $vehicleIn = Vehicle::with(['vehicleLogs', 'users'])
                ->where('number_plate', $request->number_plate)->firstOrFail();
            $logs = $vehicleIn->vehicleLogs->only('in_date');
            $logs['in_date'] = Carbon::now('Asia/Jakarta')->toDateTimeString();
            $vehicleId = $vehicleIn->only('id');
            $userId = $vehicleIn->users->pluck('id');

            DB::beginTransaction();
            VehicleLogs::create([
                'vehicle_id' => $vehicleId['id'],
                'user_id' => $userId->first(),
                'in_date' => $logs['in_date'],
            ]);
            $vehicleIn->status = 'in';
            $vehicleIn->save();
            DB::commit();

            return response()->json([
                'message' => 'Vehicle success entered, position is In now!',
                'data' => '1'
            ], 200);

        }
        
        if ($request->status == 'out') {
            foreach ($plate as $item) {
                if ($item->status != 'in') {
                    return response()->json([
                        'message' => 'Vehicle position is Out'
                    ], 404);
                }
            }
            
            $vehicleOut = Vehicle::with(['vehicleLogs', 'users'])
                ->where('number_plate', $request->number_plate)->firstOrFail();
            $vehicleId = $vehicleOut->vehicleLogs->pluck('vehicle_id');
            $userId = $vehicleOut->vehicleLogs->pluck('user_id');
            $dataLogs = VehicleLogs::where([['user_id', $userId->last()], ['vehicle_id', $vehicleId->last()]])->get();
            $logs = $dataLogs->last();
            $logs['out_date'] = Carbon::now('Asia/Jakarta')->toDateTimeString();
            $logs->save();

            DB::beginTransaction();
            $vehicle = Vehicle::findOrFail($vehicleId->first());
            $vehicle->status = 'out';
            $vehicle->save();
            DB::commit();

            return response()->json([
                'message' => 'Vehicle success got out, position is Out now!',
                'data' => '0'
            ], 200);
        }

    }
}