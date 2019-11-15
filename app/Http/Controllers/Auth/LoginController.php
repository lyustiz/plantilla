<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Symfony\Component\HttpFoundation\Request;

use JWTAuth;
use Cookie;

class LoginController extends Controller
{

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
        $this->middleware('guest')->except(['login', 'refresh', 'logout']);
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        
        if (Auth::attempt([
                'nb_usuario' => $request->get('nb_usuario'),
                'password'   => $request->get('password')
            ])) 
        {
            
            $user    = Auth::user();
            
            $payload = JWTFactory::sub($user->id_usuario)->make();
            
            $token   = JWTAuth::encode($payload);
            
            $m       = Cookie::queue('AUTH-TOKEN',$token->get(),15);

            return [ 
                'auth' => $token->get(),
                'user' => $user,
            ];
        }
        else
        {
            return response('Usuario o Contraseña Invalida', 403) ;
        }

    }
    
    public function username()
    {
        return 'nb_usuario';
    }

    public function logout(Request $request)
    {
        auth()->logout();

        JWTAuth::parseToken()->refresh();
        
        return redirect('/');
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }
}
