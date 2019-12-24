<?php

namespace App\Http\Controllers;

use App\Model\SMS;
use App\Model\TxnUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserResetPassword extends Controller
{
    public function showResetRequestForm()
    {
        return view('frontend.user.email');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:txn_users,email',
        ],
            [
                'email.required' => 'Please Enter Email',
                'email.email'    => 'Please Enter Proper Email',
                'email.exists'   => 'Email not found !',
            ]);
        try {

            $user = TxnUser::where('email', $request->email)->firstOrFail();

            $rand_otp = rand(100000, 999999);

            $user->update([
                'otp' => $rand_otp,
            ]);

            SMS::send($user->mobile, 'One Time Password (OTP) for Reset Password : ' . $rand_otp . ' HNI LIFESTYLE Note: this OTP is case sensitive, Do not Share your otp with anyone !');

            Mail::send(['html' => 'backend.mails.password-reset-otp'], ['user' => $user], function ($message) use ($user) {
                $message->to($user->email)->subject('HNI LIFESTYLE, One Time Password(OTP)');
                $message->from('support@thehatkestore.com', 'HNI LIFESTYLE');
            });

            session()->put('user', $user);

            return redirect()->action('UserResetPassword@sendOtp');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return back()->with('errors', 'Whoops, Email Not Found !')->withInput($request->all());
            }
            // return back()->with('status', 'error, ' . $ex->getMessage());
            return back()->with('status', 'Whoops, Something Went Wrong From Our End try again !');
        }
    }

    public function sendOtp()
    {
        return view('frontend.user.reset-otp');
    }

    public function resendOtp()
    {
        try {

            $userData = session()->get('user');

            $user = TxnUser::where('mobile', $userData->mobile)->where('otp', '<>', null)->firstOrFail();

            $rand_otp = rand(100000, 999999);

            $user->update([
                'otp' => $rand_otp,
            ]);

            SMS::send($user->mobile, 'One Time Password (OTP) for Reset Password : ' . $rand_otp . ' HNI LIFESTYLE Note: this OTP is case sensitive, Do not Share your otp with anyone !');

            Mail::send(['html' => 'backend.mails.password-reset-otp'], ['user' => $user], function ($message) use ($user) {
                $message->to($user->email)->subject('HNI LIFESTYLE, One Time Password(OTP)');
                $message->from('support@thehatkestore.com', 'HNI LIFESTYLE');
            });

            return redirect()->action('UserResetPassword@sendOtp');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return back()->with('errors', 'Whoops, Email Not Found !');
            }
            // return back()->with('status', 'error, ' . $ex->getMessage());
            return back()->with('status', 'Whoops, Something Went Wrong From Our End try again !');
        }
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|max:6',
        ],
            [
                'otp.required' => 'Please Enter OTP',
            ]);

        try
        {

            $userData = session()->get('user');

            $user = TxnUser::where('mobile', $userData->mobile)->where('otp', $request->otp)->firstOrFail();

            $user->update([
                'otp' => null,
            ]);

            return redirect()->action('UserResetPassword@resetForm');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return back()->with('error', 'The Entered Otp is Invalid !');
            }
            // return back()->with('status', 'error, ' . $ex->getMessage());
            return back()->with('status', 'Whoops, Something Went Wrong From Our End try again !');
        }
    }

    public function resetForm()
    {
        if (session()->get('user')) {

            return view('frontend.user.reset');
        }
        return redirect('/');

    }

    public function reset(Request $request)
    {
        $request->validate([
            'email'        => 'required|email|max:191|exists:txn_users,email',
            'password'     => 'required_with:con_password|string|max:191',
            'con_password' => 'required_with:password|same:password|string|max:191',
        ],
            [
                'email.required'             => 'Please Enter Email ID',
                'email.exists'               => 'Please Enter Valid Email ID',
                'password.required_with'     => 'Please Enter Confirm Password to Reset Password',
                'con_password.required_with' => 'Please Enter Password to Reset Password',
                'con_password.same'          => 'Please Enter Confirm Password same as Password',
            ]);
        try
        {

            $userData = session()->get('user');

            if ($userData->email != $request->email) {
                return back()->with('errors', 'Email is Invalid');
            }

            $user = TxnUser::where('email', $request->email)->firstOrFail();

            $user->update([
                'password' => bcrypt($request->password),
            ]);

            Auth::guard('user')->login($user, true);

            session()->pull('user', 'default');

            return redirect('/myaccount')->with('messageSuccess1', 'Password has been changed successfully ! ');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return back()->with('errors', 'Whoops, Email Not Found !');
            }
            // return back()->with('status', 'error, ' . $ex->getMessage());
            return back()->with('status', 'Whoops, Something Went Wrong From Our End try again !');
        }
    }
}
