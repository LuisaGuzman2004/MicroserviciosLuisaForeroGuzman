<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;

class RoleController extends Controller
{
    //
    public function index()
    {
        $user = Auth::User();
        $name = $user->name;

        //dd($name);

        return Role::all();
    }

    public function register(Request $request)
    {
        $request->validate([
            'role_id' => 'required|integer',
            'name' => 'required|string'
        ]);

        $role = Role::create([
            'role_id' => $request->role_id,
            'name' => $request->name
        ]);

        return response()->json(['message' => 'Rol registrado exitosamente', 'role' => $role], 201);
    }

    public function store(Request $request)
    {

        $request->validate([

            'role_id' => 'required',
            'name' => 'required|unique:roles',


        ],[
            'role_id.required' => 'El campo role_id es obligatorio pue weeee!.'
        ]);

        $role = new Role();

        $role->role_id = $request->role_id;
        $role->name = $request->name;

        $role->save();

        //return Role::create(['name' => $request->name]);
    }

     public function update(Request $request, Role $role){

        //dd($request);
        
        $request->validate([
            'name' => 'string|unique:roles,name,' . $role->name
        ]);
        

        $role->update($request->only(['name']));

        return response()->json(['message' => 'Rol Actualizado', 'role' => $role]);
    }

    public function destroy(Role $role){
        $role->delete();
        return response()->json(['message' => 'Rol Eliminado']);
    }

}
