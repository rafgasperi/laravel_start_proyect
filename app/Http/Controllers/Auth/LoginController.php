<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Sentinel;

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

    public function login(Request $request){

        try
        {
            // Login credentials
            $credentials = array(
                'email'    => $request->input('email'),
                'password' => $request->input('password'),
            );

            // Authenticate the user
            $auth = Sentinel::authenticate($credentials, false);

            if ($auth)
            {
                return redirect(route('dashboard'));
            }
            else
            {
                $request->session()->flash('message.error','Usuario o contraseña incorrecta!');
                return view('login');
            }

        }
        catch (Exception $e)
        {
            $request->session()->flash('message.error', $e->getMessage());
            return view('login');
        }
        catch (\Cartalyst\Sentinel\Checkpoints\ThrottlingException $e)
        {
            $request->session()->flash('message.error', 'Se ha producido una actividad sospechosa en su dirección IP y se le ha denegado el acceso durante otros 15 minutos.');
            return view('login');
        }
        catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e)
        {
            $request->session()->flash('message.error', 'Su cuenta esta inactiva , consulte con el administrador del portal para activarla.');
            return view('login');
        }
    }
}
