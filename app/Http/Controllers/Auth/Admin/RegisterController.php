<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    
    protected $redirectTo = RouteServiceProvider::ADMIN_LOGIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:70'],
            'last_name' => ['required', 'string', 'max:70'],
            'email' => ['required', 'string', 'email', 'max:70', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     * Kanak Priya Barua
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $first_name = ucwords($data['first_name']);
        $last_name = ucwords($data['last_name']);

        return User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'name' => $first_name .' '. $last_name,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_type' => 'admin',
            'last_login_ip' => request()->ip(),
        ]);

    }

    public function showRegistrationForm(){
        return view('auth.admin.register');
    }
    
    protected function guard()
    {
        return Auth::guard('admin');
    }
}


