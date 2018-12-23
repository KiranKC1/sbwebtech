<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Role;

class AclController extends Controller
{
    public function index()
    {
        $users= User::where('id','!=',Auth::User()->id)->get();
        return view('verify')->with('users',$users);
    }

    public function AssignRoles(Request $request)
    {
        $user=User::where('email',$request->email)->first();
        $user->roles()->detach();
        if($request->role_user)
        {
            $user->roles()->attach(Role::where('name','=','User')->first());
        }
        if($request->role_editor)
        {
            $user->roles()->attach(Role::where('name','=','Editor')->first());
        }
        if($request->role_admin)
        {
            $user->roles()->attach(Role::where('name','=','Admin')->first());
        }
        return back();
    }
}
