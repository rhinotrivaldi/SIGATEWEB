<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicle.index', ['vehicles' => $vehicles]);
    }

    public function add()
    {
        $categories = Category::all();
        return view('vehicle.add', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
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
        $vehicle = Vehicle::create($request->all());
        $vehicle->categories()->sync($request->categories);

        return redirect('vehicle')->with('status', 'Vehicle Added Successfully');
    }

    public function edit($slug)
    {
        $vehicle = Vehicle::where('slug', $slug)->first();
        $categories = Category::all();
        return view('vehicle.edit', ['vehicle' => $vehicle, 'categories' => $categories]);
    }

    public function update(Request $request, $slug)
    {
        
        $validated = $request->validate([
            'vehicle_name' => 'required',
            'number_plate' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif'
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
        $vehicle->update($request->all());

        if ($request->categories) {
            $vehicle->categories()->sync($request->categories);
        }

        return redirect('vehicle')->with('status', 'Vehicle Updated Successfully');
    }

    public function delete($slug)
    {
        $vehicle = Vehicle::where('slug', $slug)->first();
        $vehicle->delete();
        return redirect('vehicle')->with('status', 'Vehicle Deleted Successfully');
    }
}
