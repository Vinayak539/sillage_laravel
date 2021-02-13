<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use App\Model\SMS;
use App\Model\Subscriber;
use App\Model\TxnUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function __contruct()
    {
        $this->middleware('guard:user')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    public function showLoginForm()
    {
        return view('frontend_new.login');
    }

    public function create()
    {
        return view('frontend.user.register');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => true], $request->remeber)) {

            connectify('success', 'Logged in', 'You are successfully Logged In');

            return redirect()->intended(url()->previous());

        }

        connectify('error', 'Login Error', 'Invalid Credentials, Please Check Credentials & try again !');

        return back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        connectify('success', 'Logged Out', 'You have logged out successfully !');
        return back();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:191',
            'mobile'   => 'required|digits:10|unique:txn_users,mobile',
            'email'    => 'required|email|max:191|unique:txn_users,email',
            'password' => 'required',
        ],
            [
                'name.required'     => 'Please Enter Name',
                'mobile.required'   => 'Please Enter Mobile Number',
                'mobile.digits'     => 'Please Enter 10 digits Mobile Number',
                'email.required'    => 'Please Enter Email ID',
                'email.email'       => 'Please Enter Proper Email ID',
                'password.required' => 'Please Enter Password',
                'email.unique'      => 'Email Already Registered with us',
                'mobile.unique'     => 'Mobile Already Registered with us',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Register Failed', $validator->errors()->first());
            return back()->withInput();
        }

        $rand_otp = rand(100000, 999999);

        $user = [
            'name'        => $request->name,
            'mobile'      => $request->mobile,
            'email'       => $request->email,
            'password'    => bcrypt($request->password),
            'status'      => true,
            'is_verified' => false,
            'otp'         => $rand_otp,
            'url'         => url()->previous(),
        ];

        session(['user' => $user]);

        SMS::send($user['mobile'], 'One Time Password (OTP) for Reset Password : ' . $rand_otp . ' SILLAGE Note: this OTP is case sensitive, Do not Share your otp with anyone !');

        Mail::send(['html' => 'backend.mails.otp'], ['user' => $user], function ($message) use ($user) {
            $message->to($user['email'])->subject('SILLAGE, One Time Password(OTP)');
            $message->from('support@sillageniche.com', 'SILLAGE');
        });

        return redirect()->action('UserAuth\LoginController@otp');
    }

    public function otp(Request $request)
    {
        $user = $request->session()->get('user');
        return view('frontend.user.otp', compact('user'));
    }

    public function resendOtp(Request $request)
    {
        if ($request->session()->has('user')) {

            $user = $request->session()->get('user');

            SMS::send($user['mobile'], 'One Time Password (OTP) for Reset Password : ' . $user['otp'] . ' SILLAGE Note: this OTP is case sensitive, Do not Share your otp with anyone !');

            Mail::send(['html' => 'backend.mails.otp'], ['user' => $user], function ($message) use ($user) {
                $message->to($user['email'])->subject('SILLAGE, One Time Password(OTP)');
                $message->from('support@sillageniche.com', 'SILLAGE');
            });
            connectify('success', 'Resend Otp', 'Otp has been resend on registed mobile and email');
            return redirect()->action('UserAuth\LoginController@otp');
        }

        connectify('error', 'Error', 'Whoops, Email Not Found !');

        return back();

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
            connectify('error', 'Invalid Otp', $validator->errors()->first());
            return back()->withInput();
        }

        $userData = $request->session()->get('user');

        if ($userData['otp'] == $request->otp) {

            $user = TxnUser::updateOrCreate([
                'email' => $userData['email'],
            ],
                [

                    'name'         => $userData['name'],
                    'email'        => $userData['email'],
                    'mobile'       => $userData['mobile'],
                    'password'     => $userData['password'],
                    'status'       => true,
                    'is_verified'  => true,
                    'otp'          => null,
                    'last_login'   => \Carbon\Carbon::now(),
                    'is_subcribed' => true,
                ]);

            Subscriber::updateOrCreate([
                    'email' => $userData['email']
            ],
                [
                    'email'  => $userData['email'],
                    'status' => true,
                ]
            );

            Auth::guard('user')->login($user, true);

            connectify('success', 'Registered Successfully', 'You are successfully Registered !');

            return redirect(url($userData['url']));

        } else {

            connectify('error', 'Error', 'The Entered Otp is Invalid !');

            return back();
        }

    }

    public function showOtpLoginForm()
    {
        return view('frontend.user.otp-login');
    }

    public function otpLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10|exists:txn_users,mobile',
        ],
            [
                'mobile.required' => 'Please Enter Mobile Number',
                'mobile.digits'   => 'Please Enter 10 digits Mobile Number',
                'mobile.exists'   => 'Mobile Number does Not exists in our records !',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Otp Login', $validator->errors()->first());
            return back()->withInput();
        }

        try {

            $user = TxnUser::where('mobile', $request->mobile)->firstOrFail();

            $rand_otp = rand(100000, 999999);

            $user = [
                'name'     => $user->name,
                'mobile'   => $user->mobile,
                'email'    => $user->email,
                'password' => $user->password,
                'otp'      => $rand_otp,
                'url'      => url()->previous(),
            ];

            session(['user' => $user]);

            SMS::send($user['mobile'], 'One Time Password (OTP) for Reset Password : ' . $rand_otp . ' SILLAGE Note: this OTP is case sensitive, Do not Share your otp with anyone !');

            Mail::send(['html' => 'backend.mails.otp'], ['user' => $user], function ($message) use ($user) {
                $message->to($user['email'])->subject('SILLAGE, One Time Password(OTP)');
                $message->from('support@sillageniche.com', 'SILLAGE');
            });

            connectify('success', 'Otp Send', 'Otp has been sent on mobile & email !');

            return redirect()->action('UserAuth\LoginController@otp');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Email id not found, try again later !');

                return redirect(route('user.login.otp'));
            }

            connectify('error', 'Error', 'Something Went Wrong !');

            return redirect(route('user.login.otp'));
        }
    }

}
