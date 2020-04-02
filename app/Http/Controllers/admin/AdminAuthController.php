<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\User;

class AdminAuthController extends Controller
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
    //public $layout = 'admin.layouts.default';

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
        $this->middleware('guest')->except('logout');
    }

        public function index()
    {
        echo "Hello"; die;
        //return view('home');
    }


    public function loginForm(){
        
        return view('admin/login');
    }

    public function authenticate(Request $request){

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $username = $request->username;
        $password = $request->password;
        if (auth()->guard('admin')->attempt(['username' => $username, 'password' => $password ])) 
        {

            return redirect()->intended('admin/coupon-list');
        }
        else
        {
            return redirect()->intended('admin/login')->with('status', 'Invalid Login Credentials !');
        }

    }

    public function logout(){
        auth()->guard('admin')->logout();
        return redirect()->intended('admin/login')->with('status', 'You have successfully logged out!');
    }
}
