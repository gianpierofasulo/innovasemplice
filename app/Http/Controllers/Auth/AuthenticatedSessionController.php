<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
//use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();


                $data = [
                    'email' => $request->email,
                    'password' => $request->password,
                ];


                $response = Http::withBody(json_encode($data), 'application/json')
                        ->withOptions([ ])
                        ->post( env('APP_URL') . '/api/login');



       if ($response->successful()) {
            // Recupera il token dalla risposta
            $token = $response->json()['token'];
            session(['apiToken' => $token]);

          // return view('dashboard', ['apiToken' => $token]);
          return view('dashboard');

        }


    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $request->session()->flush();


        return redirect('/');
    }




}
