<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Category;
use App\Models\VehicleLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $categories = Category::all();
        if ($request->category || $request->search) {

            $vehicles = Vehicle::where('vehicle_name', 'like', '%'.$request->search.'%')
                        ->orWhere('number_plate', 'like', '%'.$request->search.'%')
                        ->orwhereHas('categories', function ($q) use ($request) {
                            $q->where('categories.id', $request->category);
                        })->get();


        } else {
            if (Auth::user()->role_id == 1) {
                $vehicles = Vehicle::all();
            } else {
                // $vehicles = Vehicle::all();
            }
        }

        return view('vehicle.index', ['vehicles' => $vehicles, 'categories' => $categories, 'users' => $users]);
    }

    public function add()
    {
        $categories = Category::all();
        $users = User::where([['status', 'active'], ['id', '!=', 1]])->get();
        return view('vehicle.add', ['categories' => $categories, 'users' => $users]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'user' => 'required',
            'vehicle_name' => 'required',
            'number_plate' => 'required|unique:vehicles',
        ]);

        $newName ='';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->vehicle_name.'-'.$request->number_plate.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('vehiclePic', $newName);
        }

        $request['picture'] = $newName;
        
        $num = $request['period_date'];
        $request['period_date'] = Carbon::now('Asia/Jakarta')->addDay($num)->toDateString();

        $time = $request['active_hour'];
        switch ($time) {
            case 0:
                $request['active_hour'] = 'Daily';
                break;
            case 1:
                $request['active_hour'] = 'Extends';
                break;
            default:
                $request['active_hour'] = '24 Hour';
                break;
        }
        
        $vehicle = Vehicle::create($request->all());
        $vehicle->users()->sync($request->users);
        $vehicle->categories()->sync($request->categories);

        return redirect('vehicle')->with('status', 'Vehicle Added Successfully');
    }

    public function edit($slug)
    {
        $users = User::where([['status', 'active'], ['id', '!=', 1]])->get();
        $vehicle = Vehicle::where('slug', $slug)->first();
        $categories = Category::all();
        return view('vehicle.edit', ['vehicle' => $vehicle, 'categories' => $categories, 'users' => $users]);
    }

    public function update(Request $request, $slug)
    {
        
        $validated = $request->validate([
            'vehicle_name' => 'required',
            'number_plate' => 'required',
        ]);
        
        $vehicle = Vehicle::where('slug', $slug)->first();
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->vehicle_name.'-'.$request->number_plate.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('vehiclePic', $newName);
            Storage::delete('vehiclePic'.$vehicle->picture);
            $request['picture'] = $newName;
        }
        $vehicle->slug = null;

        $num = $request['period_date'];
        $request['period_date'] = Carbon::now('Asia/Jakarta')->addDay($num)->toDateString();

        $time = $request['active_hour'];
        switch ($time) {
            case 0:
                $request['active_hour'] = 'Daily';
                break;
            case 1:
                $request['active_hour'] = 'Extends';
                break;
            default:
                $request['active_hour'] = '24 Hour';
                break;
        }

        $vehicle->update($request->all());

        if ($request->categories) {
            $vehicle->categories()->sync($request->categories);
        }

        if ($request->users) {
            $vehicle->users()->sync($request->users);
        }

        return redirect('vehicle')->with('status', 'Vehicle Updated Successfully');
    }

    public function detail($slug)
    {
        $users = User::where([['status', 'active'], ['id', '!=', 1]])->get();
        $vehicle = Vehicle::where('slug', $slug)->first();
        $categories = Category::all();
        return view('vehicle.detail', ['vehicle' => $vehicle, 'categories' => $categories, 'users' => $users]);
    }

    public function delete($slug)
    {
        $vehicle = Vehicle::where('slug', $slug)->first();
        $vehicle->delete();
        return redirect('vehicle')->with('status', 'Vehicle Deleted Successfully');
    }
}
