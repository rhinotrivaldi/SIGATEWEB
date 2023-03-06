<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('status', 'active')->get();
        return view('users.index', ['users' => $users]);
    }

    public function registered()
    {
        $newUsers = User::where('status', 'inactive')->get();
        return view('users.registered', ['newUsers' => $newUsers]);
    }

    public function approve($slug)
    {
        $userApprove = User::where('slug', $slug)->first();
        $userApprove->status = 'active';
        $userApprove->save();

        return redirect('user')->with('status', 'User Approved Successfully');
    }

}
