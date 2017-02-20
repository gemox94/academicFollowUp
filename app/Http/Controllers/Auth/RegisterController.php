<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Returning Register blade
     */
    public function registerView(){
        return view('Auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'rol' => 'required',
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|same:confirmpass',
            'confirmpass' => 'required|min:6',
            'phone' => 'required',
            'cubicle' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(Request $request)
    {
        $response = [];
        $status_code = 200;

        $validator = $this->validator($request);
        if ($validator->fails()){
            $status_code = 400;
            return response()->json($validator->errors(),$status_code);
        }else{
            $user = new User;
            $user->role_id = Input::get('rol');
            $user->name = Input::get('name');
            $user->last_name = Input::get('lastname');
            $user->email = Input::get('email');
            $user->key = Input::get('key');
            $user->password = bcrypt(Input::get('password'));
            $user->phone = Input::get('phone');
            $user->cubicle = Input::get('cubicle');
            $user->save();
            $response['user'] = $user;
            return response()->json($response, $status_code);
        }
    }
}
