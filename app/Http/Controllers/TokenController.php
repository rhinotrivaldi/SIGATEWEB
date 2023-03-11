<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function index()
    {
        $tokens = Token::all();
        return view('token.index', ['tokens' => $tokens]);
    }

    public function create(Request $request)
    {
        if ($request['submit'] == 'create') {

            $data = Token::all();
            $data->each->delete();
            $random = Str::random(60);
            Token::create([
                'token' => $random
            ]);
    
            return redirect('token')->with('status', 'Create Token Successfully');
        } else {
            $data = Token::all();
            $data->each->delete();
            return redirect('token')->with('status', 'Delete Token Successfully');
        }
    }
}
