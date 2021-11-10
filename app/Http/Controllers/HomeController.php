<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __invoke()
    {
        \Cache::put('user',  \Auth::user()->name);

        return view('home', [
            'user' => \Auth::user()
        ]);
    }
}
