<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Role;
use App\Models\RoleUser;

class RoleController extends Controller
{
    
    public function index()
    {
        $list_users = Role::all();
        return compact('list_users');
    }

    public function store(Request $request)
    {
        if( RoleUser::WHERE( 'user_id', Auth::guard('api')->user()->id )->get()[0]->role_id != 1 ) {
            $message = "Acceso denegado";
            $success = false;
            return compact('message','success');
        }
        $role = new Role();
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->description = $request->description;
        $role->save();

        $message = "Se creo un nuevo rol";
        $success = true;
        return compact('message','success');
    }

    public function show(Request $request)
    {
        $user = Role::findOrFail($request->role_id);
        return compact('user');
    }

    public function update(Request $request)
    {
        if( RoleUser::WHERE( 'user_id', Auth::guard('api')->user()->id )->get()[0]->role_id != 1 ) {
            $message = "Acceso denegado";
            $success = false;
            return compact('message','success');
        }
        $role = Role::findOrFail($request->role_id);
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->description = $request->description;
        $role->save();

        $message = "Se actualizo el rol";
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

        Role::findOrFail($request->id)->delete();

        $message = "Se elimino el rol";
        $success = true;
        return compact('message','success');
    }
}
