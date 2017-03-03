<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Role;

class CoordinatorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function create(Request $request){
        try{
            $status_code = 200;
            /*
             * Set this user as coordinator
             * 1) Update password
             * 2) Update role
             */
            $role           = Role::find(1);
            $user           = User::find($request->id);
            $user->password = bcrypt($request->password);
            $user->role()->associate($role);
            $user->save();

            $response = $user;

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }
}