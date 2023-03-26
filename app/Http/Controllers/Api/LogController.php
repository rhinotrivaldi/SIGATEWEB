<?php

namespace App\Http\Controllers\Api;

use App\Models\VehicleLogs;
use Illuminate\Http\Request;
use App\Http\Resources\LogResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user()->role_id;
        if ($user == '1') {
            $logs = VehicleLogs::all();
        } else {
            $logs = VehicleLogs::with(['user', 'vehicle'])->where('user_id', Auth::user()->id)->get();
        }
        $a = $logs;
        //dd($a);
        return LogResource::collection($a);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
