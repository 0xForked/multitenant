<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) return redirect('home');

        return view('login');
    }

    public function authenticate(Request $request)
    {
        $valid_data = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($valid_data, false)) {
            return redirect(route('home'));
        }

        return redirect(route('login'))->with([
            'message' => "login failed, email or password didn't match with our record!"
        ]);
    }
}
