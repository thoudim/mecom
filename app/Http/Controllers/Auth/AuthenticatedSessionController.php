<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        return view('auth.home');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        // $route = Route::current();
        $notification = array(
            'message' => "Login Successfully",
            'alert-type' => 'success'
        );


        $url = '';
        if (($request->user()->role === 'admin') ) {
            $url = 'admin/dashboard';
            return redirect('admin/dashboard');
        } elseif (($request->user()->role === 'vendor')) {
            $url = 'vendor/dashboard';
            return redirect('vendor/dashboard');
        } elseif (($request->user()->role === 'user')) {
            $url = '/dashboard';
            return redirect('dashboard');
        }

        // return redirect()->intended($url)->with($notification);
        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
