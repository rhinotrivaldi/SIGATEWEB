<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleLogs;
use Illuminate\Http\Request;

class VehicleLogsController extends Controller
{
    public function index()
    {
        $logs = VehicleLogs::with(['user', 'vehicle'])->get();
        return view('vehicle.vehicleLogs', ['logs' => $logs]);
    }

    public function dummy()
    {
        $users = User::where('id', '!=', 1)->get();
        $vehicles = Vehicle::all();
        return view('vehicle.dummyLogs', ['users' => $users, 'vehicles' => $vehicles]);
    }

    public function storeIn(Request $request)
    {
        $request['in_date'] = Carbon::now()->toDateTimeString();
        dd($request->all());
    }
}
