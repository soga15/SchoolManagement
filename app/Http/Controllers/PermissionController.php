<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();

        return $permissions;
    }

    public function show($id)
    {
        $permission = Permission::find($id);

        return $permission;
    }

    public function create(Request $request)
    {
        $permission = Permission::create([
            'name' =>$request->name,
            'code' =>$request->code
        ]);
        
        return $permission;
    }

    public function update($id, Request $request)
    {
        $permission = Permission::find($id);

        $permission->update([
            'name' =>$request->name,
            'code' =>$request->code
        ]);

        return $permission;
    }

    public function delete($permission_id)
    {
        $permission = Permission::find($permission_id);

        return $permission->delete();
    }
}
