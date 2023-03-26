<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Category;
use App\Models\VehicleLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $logs = VehicleLogs::with(['user', 'vehicle'])->paginate(10);

        $vehicleCount = Vehicle::count();
        $categoryCount = Category::count();
        $userCount = User::count();

        return view('admin.dashboard', [
            'vehicle_count' => $vehicleCount,
            'category_count' => $categoryCount,
            'user_count' => $userCount,
            'logs' => $logs,
        ]);
    }
}
