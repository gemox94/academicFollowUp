<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
            'phone' => 'required'
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
        $validator = $this->validator($request);
        if ($validator->fails()){
            return redirect('/register/view')
                ->withErrors($validator)
                ->withInput();
        }else{

            $user = new User;
            $user->role_id = $request->input('rol');
            $user->name = $request->input('name');
            $user->last_name = $request->input('lastname');
            $user->email = $request->input('email');
            $user->key = $request->input('key');
            $user->password = bcrypt($request->input('password'));
            $user->phone = $request->input('phone');
            $user->save();
            return redirect('/');
        }
    }
}
