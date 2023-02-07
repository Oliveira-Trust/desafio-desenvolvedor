<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\State;
use App\Models\City;


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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'min' => 'A senha deve conter mais de 8 caracteres',
            'required' => 'O campo é obrigatório',
            'confirmed' => 'A confirmação deve ser igual a senha',
            'unique' => 'E-mail já cadastrado',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 1,
            'expiration_date' => date('Y-m-d',strtotime('+15 days')),
            'state_id' => isset($data['state_id'])?$data['state_id']:null,
            'city_id' => isset($data['city_id'])?$data['city_id']:null,
            'address' => isset($data['address'])?$data['address']:null,
            'number_address' => isset($data['number_addaress'])?$data['number_addaress']:null,
            'complement_address' => isset($data['complement_address'])?$data['complement_address']:null,
            'phone' => isset($data['phone'])?$data['phone']:null,
        ]);
    }

    public function showRegistrationForm()
    {
        $states = State::orderBY('name')->get();
        return view('auth.register',compact('states'));
    }
}
