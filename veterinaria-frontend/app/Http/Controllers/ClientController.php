<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller
{
    // Esta función carga SOLO la estructura visual (HTML)
    // Es instantánea porque no llama al Backend todavía.
    public function index()
    {
        return view('clients.index');
    }

    // Esta función nueva se encargará de buscar los datos "por detrás"
    public function list()
    {
        $url = env('BACKEND_URL');
        $apiKey = env('BACKEND_API_KEY');
        $token = session('user_token');

        try {
            $response = Http::withHeaders([
                'api-key' => $apiKey,
                'Authorization' => 'Bearer ' . $token,
            ])->get($url . '/clients');

            if ($response->successful()) {
                $clients = $response->json();
                // En lugar de devolver toda la página, devolvemos solo las filas de la tabla
                return view('clients.table_rows', compact('clients'));
            }
            
            // Si falla, devolvemos un pedacito de HTML con el error
            return '<tr class="text-danger"><td colspan="5">Error al cargar datos.</td></tr>';

        } catch (\Exception $e) {
            return '<tr class="text-danger"><td colspan="5">Error de conexión.</td></tr>';
        }
    }
}