<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{

    public function showAllUsers()
    {
        $users = $this->getAllUsers()->original['users'];
        return view('users.index',compact('users'));
    }

    public function showEditUser(User $user)
    {
        return view('users.edit-user',compact('user'));
    }

    public function showCreateUser()
    {
        return view('users.create-user');
    }

    

    public function getAllUsers(){
      
        $users = User::get();
        return response()->json(['users' => $users],200);

    }

    public function getAllUsersWithLends(){
      
        $users = User::with('CustomerLends.Book')/*->has('CustomerLends.Book')*/->get();
        return response()->json(['users' => $users],200);;

    }

    public function getAllLendsByUser(User $user){
      
        $CustomerLends = $user->load('CustomerLends.Book.Category','CustomerLends.Book.Author')->CustomerLends;
        return response()->json(['customer_lends' => $CustomerLends],200);

    }

    public function getAnUser(User $user){

        return response()->json(['users' => $user],200);

    }

    public function createUser(CreateUserRequest $request){

        $user = new User($request->all());
        $user->save();
        if ($request->ajax()) return response()->json(['user' => $user],201);
        return back()->with('success' ,'Usuario Creado');
       

    }

    public function updateUsers(User $user, UpdateUserRequest $request){

        $allRequest = $request->all();
        if (isset($allRequest['password'])) {
            if(!$allRequest['password']) unset($allRequest['password']);
        }

        $user->update($request->all());
        if ($request->ajax()) return response()->json(['user' => $user->refresh()],201);
        return back()->with('success' ,'Usuario editado');
    }

    public function deleteUsers(User $user,  Request $request){

     
        $user->delete();
        if ($request->ajax()) return response()->json([],204);
        return back()->with('success' ,'Usuario eliminado');

    }

}
