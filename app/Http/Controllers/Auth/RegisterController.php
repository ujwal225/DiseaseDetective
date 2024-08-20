<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
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
    protected $redirectTo = null;

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

    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255', 'alpha'],
            'lastname' => ['required', 'string', 'max:255', 'alpha'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_type' => ['required'],
        ], $this->messages());

    }
    protected function messages(): array
    {
        return [
            'firstname.required' => 'The first name is required.',
            'firstname.alpha' => 'The first name must only contain letters.',
            'lastname.required' => 'The last name is required.',
            'lastname.alpha' => 'The last name must only contain letters.',
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be a valid email format.',
            'email.unique' => 'The email address has already been taken.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'user_type.required' => 'The user type is required.',
        ];
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['firstname'],
            'last_name' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_type' => $data['user_type'],
        ]);

        if ($user->user_type === 'Doctor') {
            Doctor::create([
                'user_id' => $user->id,



            ]);
        }
        if ($user->user_type === 'Patient') {
            Patient::create([
                'user_id' => $user->id,



            ]);
        }

        return $user;
    }

    protected function registered(Request $request, $user)
    {
        // Redirect user based on their type
        switch ($user->user_type) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'Doctor':
                return redirect()->route('doctor.dashboard');
            case 'Patient':
                return redirect()->route('patient.dashboard');
            default:
                return redirect('/home'); // Default redirect
        }
    }

}
