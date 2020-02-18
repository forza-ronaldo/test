<?php

namespace App\Http\Controllers\Auth;

use App\bemo_bank;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectToRegisterHOME = RouteServiceProvider::RegisterHOME;
    protected $redirectToClientSite = RouteServiceProvider::clientHOME;
    protected $redirectToDashboardAdmin = RouteServiceProvider::ADMIN_HOME;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'id_number' => ['required', 'string', 'max:11'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'user_name' => ['required', 'string', 'min:6', 'max:30', 'unique:users'],
            'phone' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'city' => ['required', 'string'],
            'bank_id' => ['required', 'numeric', 'unique:users,bank_id'], //'exists:bemo_banks,id'
            'gender' => ['required', 'numeric'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $url = 'http://localhost:777/bemoBank/public/api/checkRegister/' . $data['bank_id'] . '/idNumber/' . $data['id_number'];
        $found = file_get_contents($url);

        if ($found == 'true') {
            return User::create([
                'id_number' => $data['id_number'],
                'email' => $data['email'],
                'name' => $data['name'],
                'user_name' => $data['user_name'],
                'phone' => $data['phone'],
                'gender' => $data['gender'],
                'city' => $data['city'],
                'bank_id' => $data['bank_id'],
                'password' => Hash::make($data['password']),
                'group_id' => '2',
            ]);
        } else {
            session()->flash('msg', 'الرقم الوطني ورقم الحساب غير متطابقين');
        }
    }
}
