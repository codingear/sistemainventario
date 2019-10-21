<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;

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
    protected $redirectTo = 'admin';

    // protected function authenticated(Request $request, $user)
    // {
    //     if ($user->hasRole('administrador') || $user->hasRole('superAdministrador')) {
    //         return redirect('/admin');
    //     } else if ($user->hasRole('distribuidor') || $user->hasRole('cliente')) {
    //         return redirect('/admin/mi-perfil');
    //     }
    // }



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
