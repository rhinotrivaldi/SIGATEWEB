<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('status', 'active')->get();
        return view('users.index', ['users' => $users]);
    }

    public function add()
    {
        return view('users.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'username' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        Session::flash('status', 'success');
        Session::flash('status', 'Register Success');
        return redirect('user');
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
