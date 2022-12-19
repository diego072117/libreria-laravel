<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers(){
      
        $users = User::get();
        return response()->json(['users' => $users],200);

    }

    public function getAnUser(User $user){

        return response()->json(['users' => $user],200);

    }

    public function createUser(Request $request){

        $user = new User($request->all());
        $user->save();
        return response()->json(['user' => $user],201);

    }

    public function updateUsers(User $user, Request $request){

        
        $user->update($request->all());
        return response()->json(['user' => $user->refresh()],201);

    }

    public function deleteUsers(User $user){

     
        $user->delete();
        return response()->json([],204);

    }

}
