<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
//        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){
        if(!$this->getUser()){
            $cart = $this->getCartByToken();
        }
        return view('auth.login',[
            'user' => $this->getUser(),
            'cart' => isset($cart) && !empty($cart) ? $cart : null,
        ]);
    }

    public function toLogin(Request $request){
//        $validator = Validator::make($request->all(), [
//            'email' => ['required', 'email', 'max:30', 'exists:users'],
//            'password' => 'required|string',
//        ]);

        $user = User::where('email', $request['email'])->first();
        if($user && !$user->active){
            return redirect()->back()->withErrors(['error' => 'Ваш акаунт деактивовано.'])->withInput($request->all());
        }

       if(!empty($request['remember'])){
           $remember = Str::random(100);
           $credentials = $request->only('email', 'password');
           if (Auth::attempt($credentials, $remember)) {
               User::where('email', $request['email'])->update([
                   'session_token' => Str::random(60),
                   'last_logged_in' => date("Y-m-d H:i:s"),
               ]);
               return  redirect('/shop/women');
           } else{
               return redirect()->back()->withInput($request->all())->withErrors(['error' => 'Логін або пароль невірний' ]);
           }
       }else{
           $credentials = $request->only('email', 'password');
           if (Auth::attempt($credentials)) {
               User::where('email', $request['email'])->update([
                   'session_token' => Str::random(60),
                   'last_logged_in' => date("Y-m-d H:i:s"),
               ]);
               return  redirect('/shop/women');
           } else{

               return redirect()->back()->withInput($request->all())->withErrors(['error' => 'Логін або пароль невірний' ]);
           }
       }

    }

}
