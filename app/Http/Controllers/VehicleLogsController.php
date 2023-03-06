<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VehicleLogsController extends Controller
{
    public function index()
    {
        $logs = VehicleLogs::with(['user', 'vehicle'])->get();
        return view('vehicle.vehicleLogs', ['logs' => $logs]);
    }

    public function dummy()
    {
        $users = User::where([['status', 'active'], ['id', '!=', 1]])->get();
        $vehicles = Vehicle::all();
        return view('vehicle.dummyLogs', ['users' => $users, 'vehicles' => $vehicles]);
    }

    public function storeIn(Request $request)
    {
        $request['in_date'] = Carbon::now('Asia/Jakarta')->toDateTimeString();
        $statusVehicle = Vehicle::findOrFail($request->vehicle_id)->only('status');

        if ($statusVehicle['status'] != 'out') {
            Session::flash('alert-class', 'alert-danger');
            Session::flash('message', 'Vehicle position is In');
            return redirect('vehicle-dummy');
        }else {
            try {
                DB::beginTransaction();
                VehicleLogs::create($request->all());
                $vehicle = Vehicle::findOrFail($request->vehicle_id);
                $vehicle->status = 'in';
                $vehicle->save();
                DB::commit();

                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Vehicle success entered, position is In now!');
                return redirect('vehicle-dummy');
            } catch (\Throwable $e) {
                DB::rollBack();
                dd($e);
            }
        }
        
    }
}
