<?php

namespace App\Http\Controllers;

use App\Models\VehicleLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $logs = VehicleLogs::with(['user', 'vehicle'])->where('user_id', Auth::user()->id)->get();
        return view('user.index', ['logs' => $logs]);
    }
}
