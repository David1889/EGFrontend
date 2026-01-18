<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    //LISTAR 
    // Vista principal (Esqueleto)
    public function index()
    {
        return view('pets.index');
    }

    // Obtener datos vía AJAX
    public function list()
    {
        $url = env('BACKEND_URL');
        $apiKey = env('BACKEND_API_KEY');
        $token = session('user_token');

        try {
            $response = Http::withHeaders([
                'api-key' => $apiKey,
                'Authorization' => 'Bearer ' . $token,
            ])->get($url . '/pets');

            if ($response->successful()) {
                $pets = $response->json();
                return view('pets.table_rows', compact('pets'));
            }

            // Si falla, retornamos error
            return '<tr class="text-danger"><td colspan="6">Error al cargar mascotas.</td></tr>';

        } catch (\Exception $e) {
            return '<tr class="text-danger"><td colspan="6">Error de conexión.</td></tr>';
        }
    }

    // ALTA
    // Mostrar formulario (cargar los dueños para el select)
    public function create()
    {
        $url = env('BACKEND_URL');
        $apiKey = env('BACKEND_API_KEY');
        $token = session('user_token');

        // lista de clientes para el desplegable
        $response = Http::withHeaders([
            'api-key' => $apiKey,
            'Authorization' => 'Bearer ' . $token,
        ])->get($url . '/clients');

        $clients = $response->successful() ? $response->json() : [];

        return view('pets.create', compact('clients'));
    }

    // Guardar la nueva mascota
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'cliente_id' => 'required', // Obligatorio elegir dueño
            'fecha_de_nac' => 'required|date',
            'raza' => 'required',
            'color' => 'required',
            // foto es opcional
        ]);

        $url = env('BACKEND_URL');
        $apiKey = env('BACKEND_API_KEY');
        $token = session('user_token');

        try {
            $response = Http::withHeaders([
                'api-key' => $apiKey,
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->post($url . '/pets', [
                'nombre' => $request->nombre,
                'cliente_id' => $request->cliente_id, // El ID del dueño seleccionado
                'raza' => $request->raza,
                'color' => $request->color,
                'fecha_de_nac' => $request->fecha_de_nac,
                'foto' => $request->foto,
            ]);

            if ($response->successful()) {
                return redirect()->route('pets.index')->with('success', 'Paciente registrado exitosamente.');
            }

            return back()->withErrors(['api_error' => 'Error al guardar: ' . $response->body()])->withInput();

        } catch (\Exception $e) {
            return back()->withErrors(['connection' => 'Error de conexión.'])->withInput();
        }
    }
    // EDITAR MASCOTA
    public function edit($id)
    {
        $url = env('BACKEND_URL');
        $apiKey = env('BACKEND_API_KEY');
        $token = session('user_token');

        $petResponse = Http::withHeaders([
            'api-key' => $apiKey, 'Authorization' => 'Bearer ' . $token,
        ])->get($url . '/pets/' . $id);

        // clientes para el select
        $clientsResponse = Http::withHeaders([
            'api-key' => $apiKey, 'Authorization' => 'Bearer ' . $token,
        ])->get($url . '/clients');

        if ($petResponse->successful() && $clientsResponse->successful()) {
            $pet = $petResponse->json();
            $clients = $clientsResponse->json();
            return view('pets.edit', compact('pet', 'clients'));
        }

        return redirect()->route('pets.index')->withErrors(['error' => 'No se pudieron cargar los datos.']);
    }

    // Actualizar
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'cliente_id' => 'required',
            'raza' => 'required',
            'color' => 'required',
            'fecha_de_nac' => 'required|date',
        ]);

        $url = env('BACKEND_URL');
        $apiKey = env('BACKEND_API_KEY');
        $token = session('user_token');

        try {
            $response = Http::withHeaders([
                'api-key' => $apiKey, 'Authorization' => 'Bearer ' . $token, 'Accept' => 'application/json',
            ])->put($url . '/pets/' . $id, [
                'nombre' => $request->nombre,
                'cliente_id' => $request->cliente_id,
                'raza' => $request->raza,
                'color' => $request->color,
                'fecha_de_nac' => $request->fecha_de_nac,
                'foto' => $request->foto,
            ]);

            if ($response->successful()) {
                return redirect()->route('pets.index')->with('success', 'Paciente actualizado correctamente.');
            }

            return back()->withErrors(['api_error' => 'Error al actualizar: ' . $response->body()]);

        } catch (\Exception $e) {
            return back()->withErrors(['connection' => 'Error de conexión.']);
        }
    }

    // BAJA
    public function destroy($id)
    {
        $url = env('BACKEND_URL');
        $apiKey = env('BACKEND_API_KEY');
        $token = session('user_token');

        try {
            $response = Http::withHeaders([
                'api-key' => $apiKey, 'Authorization' => 'Bearer ' . $token,
            ])->delete($url . '/pets/' . $id);

            if ($response->successful()) {
                return redirect()->route('pets.index')->with('success', 'Paciente eliminado correctamente.');
            }

            return back()->withErrors(['api_error' => 'No se pudo eliminar.']);

        } catch (\Exception $e) {
            return back()->withErrors(['connection' => 'Error de conexión.']);
        }
    }
}