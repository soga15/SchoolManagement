<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return $roles;
    }

    public function show($id)
    {
        $role = Role::find($id);

        return $role;
    }

    public function create (Request $request)
    {
        $role = Role::create([
            'name' => $request->name
        ]);

        return $role;
    }

    public function update($id, Request $request)
    {
        $role = Role::find($id);

        $role->update([
            'name'=> $request->name
        ]);
        
        return $role;
    }


    public function delete($role_id)
    {
        $role = Role::find($role_id);

        return $role->delete();
    }  
}
