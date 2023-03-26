<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\UserVehicle;
use App\Models\VehicleLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $logs = VehicleLogs::with(['user', 'vehicle'])->where('user_id', Auth::user()->id)->get();
        $vehicles = UserVehicle::with(['user', 'vehicle'])->where('user_id', Auth::user()->id)->get();
        //dd($vehicles);
        return view('user.index', ['logs' => $logs, 'vehicles' => $vehicles]);
    }
}
