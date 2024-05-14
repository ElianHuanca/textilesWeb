<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos los usuarios
        $users = User::orderBy('id', 'asc')->paginate(5);
        // Retornar la vista 'usuario.index' y pasar los datos de los usuarios a la vista
        return view('usuario.index', compact('users'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retornar la vista 'usuario.create'
        return view('usuario.register');
    }
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        // Crear un nuevo usuario
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
    
        // Retornar una respuesta de éxito y redirigir a la vista de usuarios
        return redirect()->route('users.index');
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // Retornar la vista 'usuario.edit' y pasar los datos del usuario a la vista
        return view('usuario.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        // Validar los datos de entrada para la actualización
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'required|string|min:8',
        ]);

        // Actualizar los datos del usuario
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Retornar una respuesta de éxito con el usuario actualizado
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Eliminar el usuario
        $user->delete();

        // Retornar una respuesta de éxito
        return redirect()->route('users.index');
    }
}
