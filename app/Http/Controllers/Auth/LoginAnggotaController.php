<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\Anggota;
use App\Models\Users;
use Auth;
class LoginAnggotaController extends Controller
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

    use Anggota;
    protected $username;
    protected $users_models;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->users_models = new Users();
        $this->username = $this->findUsername();
    }
    public function findUsername()
    {
        $login = request()->input('login');

        if($login && $this->users_models->isNIPExist($login)){
            $fieldType = 'nip';
        } else {
            $fieldType = 'nis';
        }

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }
    
    public function username()
    {
        return $this->username;
    }
    
}
