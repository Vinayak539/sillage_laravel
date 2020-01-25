<?php

namespace App\Http\Controllers;

use App\Model\SMS;
use App\Model\TxnUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserResetPassword extends Controller
{
    public function showResetRequestForm()
    {
        return view('frontend.user.email');
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:txn_users,email',
        ],
            [
                'email.required' => 'Please Enter Email',
                'email.email'    => 'Please Enter Proper Email',
                'email.exists'   => 'Email not found !',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Error', $validator->errors()->first());
            return back()->withInput();
        }

        try {

            $user = TxnUser::where('email', $request->email)->firstOrFail();

            $rand_otp = rand(100000, 999999);

            $user->update([
                'otp' => $rand_otp,
            ]);

            SMS::send($user->mobile, 'One Time Password (OTP) for Reset Password : ' . $rand_otp . ' HNI Lifestyle Note: this OTP is case sensitive, Do not Share your otp with anyone !');

            Mail::send(['html' => 'backend.mails.password-reset-otp'], ['user' => $user], function ($message) use ($user) {
                $message->to($user->email)->subject('HNI Lifestyle, One Time Password(OTP)');
                $message->from('support@hnilifestyle.com', 'HNI Lifestyle');
            });

            session()->put('user', $user);

            return redirect()->action('UserResetPassword@sendOtp');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                
                connectify('error', 'Invalid Email', 'Whoops, Email Not Found !');

                return back()->withInput($request->all());

            }
            
            connectify('error', 'Error', 'Whoops, Something Went Wrong From Our End try again !');

            return back();

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

            SMS::send($user->mobile, 'One Time Password (OTP) for Reset Password : ' . $rand_otp . ' HNI Lifestyle Note: this OTP is case sensitive, Do not Share your otp with anyone !');

            Mail::send(['html' => 'backend.mails.password-reset-otp'], ['user' => $user], function ($message) use ($user) {
                $message->to($user->email)->subject('HNI Lifestyle, One Time Password(OTP)');
                $message->from('support@hnilifestyle.com', 'HNI Lifestyle');
            });

            return redirect()->action('UserResetPassword@sendOtp');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Invalid Email', 'Whoops, Email Id Not Found !');

                return back();
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong From Our End try again !');

            return back();

        }
    }

    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|max:6',
        ],
            [
                'otp.required' => 'Please Enter OTP',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Error', $validator->errors()->first());
            return back()->withInput();
        }
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

                connectify('error', 'Invalid Otp', 'The Entered Otp is Invalid !');

                return back();

            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong From Our End try again !');

            return back();

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
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            connectify('error', 'Error', $validator->errors()->first());
            return back()->withInput();
        }
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

            connectify('success', 'Success', 'Password has been changed successfully !');

            return redirect(route('user.dashboard'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'error', 'Whoops, Email Not Found !');

                return back();
            }

            connectify('error', 'error', 'Whoops, Something Went Wrong From Our End try again !');

            return back();

        }
    }
}
