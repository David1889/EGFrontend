<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // facade para hacer peticiones HTTP a otros servicios 

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            // Recuperamos las credenciales del archivo .env
            $url = env('BACKEND_URL');
            $apiKey = env('BACKEND_API_KEY');

            // Hacemos la petición 
            $response = Http::withHeaders([
                'api-key' => $apiKey
            ])->post($url . '/users/login', [
                'email' => $request->email,
                'password' => $request->password,
            ]);

            if ($response->successful()) {
                $data = $response->json();

                session([
                    'user_token' => $data['token'] ?? null,
                    'user_email' => $request->email,
                    'user_id'    => $data['user']['id'] ?? ($data['id'] ?? 1),
                ]);

                return redirect()->intended('/');
            } 
            
            // Manejo de errores 401/403
            return back()->withErrors([
                'email' => 'Credenciales incorrectas o acceso denegado por el servidor.',
            ])->onlyInput('email');

        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Error de conexión con el Backend. Verifique que esté encendido.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        $token = session('user_token');
        $url = env('BACKEND_URL');
        $apiKey = env('BACKEND_API_KEY');

        if ($token) {
            Http::withHeaders([
                'api-key' => $apiKey
            ])->withToken($token)->post($url . '/users/logout');
        }

        $request->session()->flush();
        return redirect('/');
    }
}