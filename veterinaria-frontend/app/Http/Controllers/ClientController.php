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

    // ALTA 
    // Mostrar el formulario vacío
    public function create()
    {
        return view('clients.create');
    }

    // Recibir los datos y mandarlos a la API
    public function store(Request $request)
    {
        // Validación básica 
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email',
            'telefono' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
        ]);

        $url = env('BACKEND_URL');
        $apiKey = env('BACKEND_API_KEY');
        $token = session('user_token');
        $currentUserId = session('user_id', 1); // Si no encuentra nada, usa 1 por defecto

        try {
            // Enviamos los datos a la API: POST /api/clients
            $response = Http::withHeaders([
                'api-key' => $apiKey,
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json', // Importante para recibir errores limpios
            ])->post($url . '/clients', [
                // Mapeamos los inputs del form a lo que espera la base de datos
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'ciudad' => $request->ciudad,
                'direccion' => $request->direccion,
                'user_id' => $currentUserId,
            ]);

            // Si se creó correctamente (Código 201 Created o 200 OK)
            if ($response->successful()) {
                return redirect()->route('clients.index')
                    ->with('success', 'Cliente registrado exitosamente.');
            }

            // Si la API rechaza los datos (ej: email repetido)
            if ($response->status() === 422) {
                return back()
                    ->withErrors($response->json()['errors'] ?? ['Error de validación en la API'])
                    ->withInput();
            }

            return back()->withErrors(['api_error' => 'Error al guardar: ' . $response->body()])->withInput();

        } catch (\Exception $e) {
            return back()->withErrors(['connection' => 'Error de conexión con el servidor.'])->withInput();
        }
    }


    // EDICIÓN
    // Mostrar formulario con datos cargados
    public function edit($id)
    {
        $url = env('BACKEND_URL');
        $apiKey = env('BACKEND_API_KEY');
        $token = session('user_token');

        // Pedimos al backend los datos de ESTE cliente: GET /api/clients/5
        $response = Http::withHeaders([
            'api-key' => $apiKey,
            'Authorization' => 'Bearer ' . $token,
        ])->get($url . '/clients/' . $id);

        if ($response->successful()) {
            // El backend devuelve el objeto cliente (json)
            $client = $response->json();
            return view('clients.edit', compact('client'));
        }

        return redirect()->route('clients.index')->withErrors(['error' => 'No se encontró el cliente.']);
    }

    // Guardar los cambios
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'telefono' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
        ]);

        $url = env('BACKEND_URL');
        $apiKey = env('BACKEND_API_KEY');
        $token = session('user_token');
        $currentUserId = session('user_id', 1);

        try {
            // Usamos PUT para actualizar: PUT /api/clients/5
            $response = Http::withHeaders([
                'api-key' => $apiKey,
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->put($url . '/clients/' . $id, [
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'ciudad' => $request->ciudad,
                'direccion' => $request->direccion,
                'user_id' => $currentUserId,
            ]);

            if ($response->successful()) {
                return redirect()->route('clients.index')
                    ->with('success', 'Cliente actualizado correctamente.');
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
            // Enviamos la petición DELETE: DELETE /api/clients/5
            $response = Http::withHeaders([
                'api-key' => $apiKey,
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->delete($url . '/clients/' . $id);

            // Manejo de respuestas
            if ($response->successful()) {
                return redirect()->route('clients.index')
                    ->with('success', 'Cliente eliminado correctamente.');
            }

            // Si falla (ej: tiene mascotas asociadas y la BD no deja borrarlo)
            return back()->withErrors(['api_error' => 'No se pudo eliminar: ' . $response->body()]);

        } catch (\Exception $e) {
            return back()->withErrors(['connection' => 'Error de conexión al intentar eliminar.']);
        }
    }
}