<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Model\Admin;
use Auth;
use Illuminate\Http\Request;
use Lang;

class LoginController extends Controller
{

    public function __contruct()
    {
        $this->middleware('guard:admin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('adminauth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remeber)) {
            return redirect()->intended(url()->previous());
        }
        return redirect(route('login'))->withInput($request->only('email', 'remember'))->withErrors(['email' => Lang::get('auth.failed')]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->intended(route('login'));
    }

    public function checkEmail(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();
        if ($admin) {
            return "true";
        }
        return "false";
    }
}
