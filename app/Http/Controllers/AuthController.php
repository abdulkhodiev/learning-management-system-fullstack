<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\RegisterAction;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * @var LoginAction
     */
    protected $loginAction;
    /**
     * @var LogoutAction
     */
    protected $logoutAction;
    /**
     * @var
     */
    protected $registerAction;

    /**
     * @param LoginAction $loginAction
     * @param LogoutAction $logoutAction
     * @param RegisterAction $registerAction
     */
    public function __construct(
        LoginAction $loginAction,
        LogoutAction $logoutAction,
        RegisterAction $registerAction,
    ) {
        $this->loginAction = $loginAction;
        $this->logoutAction = $logoutAction;
        $this->createUserAction = $registerAction;
    }

    // Login methods

    /**
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function showLoginForm()
    {
        return inertia('Auth/Login');
    }


    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if ($this->loginAction->execute($credentials )) {
            return redirect()->route('roles.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $this->logoutAction->execute($request);

        return redirect()->route('home');
    }


    /**
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function showRegisterForm()
    {
        return inertia('Auth/Register');
    }


    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();


        $user = $this->registerAction->execute($validated);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
