<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{

    public function showAllUsers()
    {
        $users = $this->getAllUsers()->original['users'];
        return view('users.index',compact('users'));
    }
 
    public function showCreateUser()
    {
        $roles = $this->getAllRoles()->original['roles'] ;
        return view('users.create-user', compact('roles'));
    }

    public function showEditUser(User $user)
    {
        $user->load('roles');
        $roles = $this->getAllRoles()->original['roles'];
        return view('users.edit-user',compact('user', 'roles'));
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

    public function getAllRoles()
    {
        $roles = Role::all()->pluck('name');
        return response()->json(['roles' => $roles], 200);
    }

    public function createUser(CreateUserRequest $request){

        try {
            DB::beginTransaction();
            $user = new User($request->all());
            $user->save();
            $user->assignRole($request->role);
            DB::commit();
            if ($request->ajax()) return response()->json(['user' => $user],201); 
            return back()->with('success' ,'Usuario Creado');
            
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

    }

    public function updateUsers(User $user, UpdateUserRequest $request){
        try {
            DB::beginTransaction();
                $allRequest = $request->all();
                if (isset($allRequest['password'])) {
                    if(!$allRequest['password']) unset($allRequest['password']);
                }

                $user->update($request->all());
                $user->syncRoles($request->role);
                
            DB::commit();

            if ($request->ajax()) return response()->json(['user' => $user->refresh()],201);
            return back()->with('success' ,'Usuario editado');

        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function deleteUsers(User $user,  Request $request){

     
        $user->delete();
        if ($request->ajax()) return response()->json([],204);
        return back()->with('success' ,'Usuario eliminado');

    }

}
