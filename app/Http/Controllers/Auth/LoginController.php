<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
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

    protected function authenticated()
    {
        if (auth()->user()->sesi == FALSE) {
            $this->guard()->logout();
            return redirect()->route('login')->with('rusak', 'Sesi Sudah Berakhir');
        }
    }

    public function logout(Request $request) {
        $this->guard()->logout();
        $request->session()->invalidate();
        if($request->ajax()) {
            return response()->json(['success' => 'Terima Kasih Telah Memilih'], 200);
        }
        else {
            return redirect('/');
        }
    }
}
