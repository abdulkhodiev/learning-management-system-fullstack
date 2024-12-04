<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutAction
{
    /**
     * Execute the logout process for the authenticated user.
     *
     * This method logs out the user, invalidates the current session,
     * and regenerates the session token to prevent session fixation attacks.
     *
     * @param Request $request The current HTTP request instance.
     */
    public function execute(Request $request): void
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
