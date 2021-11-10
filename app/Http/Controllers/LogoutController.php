<?php

namespace App\Http\Controllers;

class LogoutController
{
    public function __invoke()
    {
        auth()->logout();

        return redirect(route('home'));
    }
}
