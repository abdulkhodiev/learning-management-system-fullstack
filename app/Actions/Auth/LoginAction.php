<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;

class LoginAction
{

    /**
     * Execute the authentication attempt.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function execute(array $credentials): bool
    {
        if (Auth::attempt($credentials, )) {
            session()->regenerate();
            return true;
        }

        return false;
    }
}
