<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;

class LoginAction
{
    public function execute(array $credentials): bool
    {
        if (Auth::attempt($credentials, )) {
            session()->regenerate();
            return true;
        }

        return false;
    }
}
