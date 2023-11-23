<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsuarioController extends Controller
{
    // Validar - Crear profesionales o pacientes
    public function store(Request $request)
    {
        $request->validate([
            'numero_identificacion' => 'required|unique:usuarios',
            'nombre' => 'required',
            'apellidos' => 'required',
            'correo' => 'required|email|unique:usuarios',
            'celular' => 'required',
            'ubicacion' => 'required',
            'password' => 'required',
            'tipo' => 'required|in:profesional,paciente',
        ]);

        try {

        $usuario = Usuario::create([
            'numero_identificacion' => $request->input('numero_identificacion'),
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'correo' => $request->input('correo'),
            'celular' => $request->input('celular'),
            'ubicacion' => $request->input('ubicacion'),
            'password' => Hash::make($request->input('password')),
            'tipo' => $request->input('tipo'),
        ]);

        // Después de crear el usuario, generamos el token
        $token = JWTAuth::fromUser($usuario);

            return response()->json(['message' => 'Usuario registrado con éxito', 'token' => $token]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al registrar usuario', 'details' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Usuario registrado con éxito', 'token' => $token]);
    }

    // Autenticación de usuarios
    public function login(Request $request)
    {
        $credentials = $request->only(['numero_identificacion', 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciales no válidas'], 401);
        }

        return response()->json(['token' => $token]);
    }


    public function getUser(Request $request)
    {
        // Obtener el usuario autenticado a través del token JWT
        $user = auth()->user();

        // Puedes personalizar la información que devuelves según tus necesidades
        return response()->json(['user' => $user]);
    }


    public function index()
    {
        // Mostrar lista de profesionales o pacientes
        $usuarios = Usuario::all();
        return response()->json($usuarios);
    }

    public function show($id)
    {
        // Mostrar detalles de un profesional o paciente
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario);
    }

    public function update(Request $request, $id)
    {
        // Actualizar información de un profesional o paciente
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());

        return response()->json(['message' => 'Usuario actualizado con éxito']);
    }

    public function destroy($id)
    {
        // Eliminar un profesional o paciente
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return response()->json(['message' => 'Usuario eliminado con éxito']);
    }

}
