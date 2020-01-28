<?php

namespace App\Http\Controllers\ShopAuth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class LoginController extends Controller
{

    public function __contruct()
    {
        $this->middleware('guard:shop')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('shop');
    }

    public function showLoginForm()
    {
        return view('shopauth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('shop')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => true], $request->remeber)) {

            connectify('success', 'Logged In', 'You Are Successfully Logged In !');

            return redirect()->intended(url()->previous());

        }

        connectify('error', 'Error', 'Invalid Username or Password, try again !');
        return back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('shop')->logout();

        connectify('success', 'Logged Out', 'You Are Successfully Logged Out !');

        return redirect(route('shop.login'));
    }

}
