<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    //
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users,email,' . $user->id,
            'role_id' => 'integer'
        ]);

        $user->update($request->only(['name', 'email', 'role_id']));

        return response()->json(['message' => 'Perfil actualizado', 'user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado']);
    }


    public function getUserRole(Request $request, $userId)
    {
        $user = User::with('role')->find($userId);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        return response()->json([
            'user_id' => $user->id,
            'role_id' => $user->role->role_id, // Accediendo a role_id
            'role_name' => $user->role->name,
        ], 200);
    }


}
