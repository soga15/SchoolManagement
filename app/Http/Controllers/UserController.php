<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();

        return $users;
    }

    public function show($id)
    {
        $user = User::with('role')->find($id);

        return $user;
    }

    public function create (Request $request)
    {
        $user = User::create([
            'firstname'=> $request->firstname,
            'lastname'=> $request->lastname,
            'gender'=> $request->gender,
            'address'=> $request->address,
            'birthdate'=> $request->birthdate,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'role_id'=> $request->role_id
        ]);

        return $user;
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);

        $user->update([
            'firstname'=> $request->firstname,
            'lastname'=> $request->lastname,
            'gender'=> $request->gender,
            'address'=> $request->address,
            'birthdate'=> $request->birthdate,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'role_id'=> $request->role_id
        ]);
        
        return $user;
    }


    public function delete($user_id)
    {
        $user = User::find($user_id);

        return $user->delete();
    }   

    
    
}
