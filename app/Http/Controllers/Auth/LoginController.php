<?php

namespace App\Http\Controllers\Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        // dd($user);
        if(!empty($user)){

            if ($user->active == 0) {
                Session::flash('loginMessage', "You are not active person, Please contact with admin.");
                return [
                    'email' => $request->{$this->username()},
                    'password' => $request->password,
                    'active' => '0',
                ];
            } else {
                return [
                    'email' => $request->{$this->username()},
                    'password' => $request->password,
                    'active' => '1',
                ];
                
            }
        }
        return $request->only($this->username(), 'password');    
    }
}
