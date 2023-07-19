<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Models\RoleUser;

class UserController extends Controller
{
    //Authentication
    public function login(Request $request) {
        $credencials = $request->only('email', 'password');
        if(Auth::guard('api')->attempt($credencials)){
            $user = Auth::guard('api')->user();
            $jwt = JWTAuth::attempt($credencials);
            $success = true;
            $data = compact('user', 'jwt');
            return compact('success', 'data');
        } else {
            $success = false;
            $message = 'Credenciales Incorrectas';
            return compact('success', 'message');
        }
    }

    public function logout(Request $request) {
        Auth::guard('api')->logout();
        $success = true;
        return compact('success');
    }

    //Funciones CRUD
    public function index()
    {
        $list_users = User::all();
        return compact('list_users');
    }

    public function store(Request $request)
    {
        if( RoleUser::WHERE( 'user_id', Auth::guard('api')->user()->id )->get()[0]->role_id != 1 ) {
            $message = "Acceso denegado";
            $success = false;
            return compact('message','success');
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = Carbon::now();
        $user->password = Hash::make($request->password);
        $user->save();

        $role_user = new RoleUser();
        $id_user = User::WHERE('email',$request->email)->get('id');
        $role_user->user_id = $id_user[0]->id;
        $role_user->role_id = $request->role_id;
        $role_user->save();

        $message = "Se creo un nuevo usuario";
        $success = true;
        return compact('message','success');
    }

    public function show(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        return compact('user');
    }

    public function update(Request $request)
    {
        if( RoleUser::WHERE( 'user_id', Auth::guard('api')->user()->id )->get()[0]->role_id != 1 ) {
            $message = "Acceso denegado";
            $success = false;
            return compact('message','success');
        }

        $user = User::findOrFail($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $id_role_user = RoleUser::WHERE( 'user_id', $request->user_id )->get()[0]->id;
        $role_user = RoleUser::findOrFail($id_role_user);
        $role_user->user_id = $request->user_id;
        $role_user->role_id = $request->role_id;
        $role_user->save();

        $message = "Se actualizo el usuario";
        $success = true;
        return compact('message','success');
    }

    public function destroy(Request $request)
    {
        if( RoleUser::WHERE( 'user_id', Auth::guard('api')->user()->id )->get()[0]->role_id != 1 ) {
            $message = "Acceso denegado";
            $success = false;
            return compact('message','success');
        }

        RoleUser::findOrFail($request->id)->delete();
        User::findOrFail($request->id)->delete();

        $message = "Se elimino un usuario";
        $success = true;
        return compact('message','success');
    }
}
