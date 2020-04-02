<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Jobs\UserCreated;
use Illuminate\View\Factory;
use App\Services\PayPlanService as Service;
use App\Http\Requests\SubscriptionPostRequest;

class VipController extends Controller
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */ 
    private $service;

    public function __construct (Service $service) {
        $this->middleware('guest');
        $this->service = $service;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function index (Request $request, Factory $view )
    {   $user = new User();
        return $view->make('auth.vip-register',['payplans'=>$this->service->getPayplans($request), 'intent' => $user->createSetupIntent(), 'stripe_key'=> env('STRIPE_KEY')]);
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
            'name' => ['bail', 'required', 'string', 'max:255'],
            'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['bail', 'required', 'string', 'confirmed'],
            'reference_code' => ['bail', 'nullable', 'string', 'size:10', 'exists:users'],
            'plan'=>['bail', 'required', 'string'],
            'card_holder_name' => ['bail','required','string']

        ]);
    }

    protected function create( array $data) {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => app('hash')->make($data['password']),
            'role' => $this->getRole ()
        ]);
        $this->purchase($user, $data);
        return $user;
    }

    protected function registered (Request $request, User $user) {
        $this->redirectTo = $user->role === 'admin' ? 'admin/coupons' : $this->redirectTo;
        dispatch(new UserCreated($user, $request->input('reference_code', null)));
    }

    protected function getRole ():string {
        return ((bool) User::count()) ? 'user' : 'admin';
    }

    public function purchase (User $user, $data) {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        if(empty($user->stripe_id)){
            $user->createAsStripeCustomer();
        }
        return $user->newSubscription('main', $data['plan'])->create($data['paymentMethod'], [
            'email' => $user->email,
        ]);
    }

}