<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Student;
use App\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/dashboard';

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
            'status' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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

        $user = User::create([
            'status' => $data['status'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // last id
        $user_id        = $user->id;
        $student_no     = 'KBS/'.date('Y').'/';
        $student_no     .= substr(rand(10000, 100000000), 0, 6);

        Student::create([
            'student_id'    => $user_id,
            'student_no'    => $student_no
        ]);

        if( $data['status'] =='old' && $user_id !== null ) {
            Payment::create([
                'student_id'    => $user_id,
                'payment_type'  => 'form',
                'amount'        => '0.0',
                'status'        => 'success',
                'currency'      => 'NGN',
                'ref_num'       => '0000'
            ]);
        }

        return $user;
    }
}
