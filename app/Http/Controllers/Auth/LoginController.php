<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Period;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest', ['except' => 'logout']);
    }


    /*
     * Login
     */
    public function login(){
        $email    = Input::get('email');
        $password = Input::get('password');
        $response = [];
        $status_code = 200;

        $user = User::where('email', $email)->first();

        if(!$user){
            return response()->json(['description' => 'Correo o contraseña incorrectos', 'alert_type' => 'danger'], 400);
        }

        if (Auth::attempt(['email' => $email, 'password' => $password])){
            $user             = Auth::user()->load('role');
            $period = Period::where('status', 'active')->first();
            \session(['period' => $period->period]);
            $response['user'] = $user;

        }else{
            $status_code = 400;
            $response['description'] = 'Correo o contraseña erróneos';
            $response['alert_type']  = 'danger';

        }

        return response()->json($response, $status_code);

    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
