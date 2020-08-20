<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Config;

class UserController extends Controller
{
    public function __construct()
    {
        Config::set('auth.defaults.guard','web');
    }
    public function signIn()
    {
        if (session()->has('user_login')) {
            return redirect(route('home'));
        }else{
            return view('layouts.frontEnd.accounts.signIn',['title'=>trans('admin.signup')]);
        }
    }
    public function signUp()
    {
        return view('layouts.frontEnd.accounts.signUp',['title'=>trans('admin.signup')]);
    }
    public function store(UserRequest $request)
    {
        User::create($request->all());

        $credential = [
            'email'                 => $request->get('email'),
            'password'              => $request->get('password'),
        ];

        if ($this->doLogin( $credential)) {
            return redirect()->route('home');
        }
        return back();
    }
    private function rules()
    {
        return [
            'email'                 => 'required',
            'password'              => 'required',
        ];
    }
    private function messages()
    {
        return [
            'email.required'        => trans('admin.email_required'),
            'password.required'     => trans('admin.password_required'),

        ];
    }
    public function login()
    {
        $credential = $this->validate(request(),$this->rules(),$this->messages());

        if ($this->doLogin($credential)) {
            return redirect()->route('home');
        }
        return back();
    }

    private function doLogin($credential)
    {
        if (auth()->guard('web')->attempt($credential,1))
        {
            session()->put('user_login',true);
            return true;
        }
        return false;
    }
    public function logout()
    {
    	auth()->guard('web')->logout();
        session()->forget('user_login');
        session()->forget('cart');
    	return redirect()->route('home');
    }
}
