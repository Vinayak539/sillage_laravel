<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\Subscriber;
use App\Model\TxnOrder;
use App\Model\TxnUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subscribers  = Subscriber::where('status', true)->count();
        $today_users  = TxnUser::whereDate('created_at', \Carbon\Carbon::today())->count();
        $todays_sales = TxnOrder::where('status', 'Booked')->whereDate('created_at', \Carbon\Carbon::today())->sum('total');
        $orders       = TxnOrder::whereNotIn('status', ['nc', 'Pending', 'Returned'])->whereDate('created_at', \Carbon\Carbon::today())->count();

        $new_orders = TxnOrder::whereNotIn('status', ['nc', 'Pending', 'Returned'])->with('user')->latest()->limit(10)->get();
        $new_users  = TxnUser::latest()->limit(10)->get();

        return view('adminauth.index', compact(['todays_sales', 'today_users', 'orders', 'subscribers', 'new_orders', 'new_users']));
    }


    public function edit()
    {
        try {

            $admin = Admin::where('id', auth('admin')->user()->id)->firstOrFail();
            return view('adminauth.edit', compact('admin'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, Account Not Found !');

                return redirect(route('admin.dashboard'));
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end');

            return redirect(route('admin.dashboard'));
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:191',
            'password'     => 'required_with:old_password|max:191',
            'old_password' => 'required_with:password|max:191',
        ],
            [
                'name.required'          => 'Please Enter Name',
                'password.required_with' => 'Please Enter New Password to change Password',
                'old_password.required_with' => 'Please Enter Old Password to chnage Password'
            ]);

        if ($validator->fails()) {
            connectify('error', 'Error', $validator->errors()->first());
            return redirect(route('admin.profile'))->withInput();
        }

        try {

            $admin = Admin::where('id', auth('admin')->user()->id)->firstOrFail();

            if ($request->hasFile('image_url')) {

                $old_image = public_path("/storage/images/admins/" . $admin->image_url);

                if (File::exists($old_image)) {
                    File::delete($old_image);
                }

                $admin->update([
                    'image_url' => uniqid() . '.' . pathinfo($request->image_url->getClientOriginalName(), PATHINFO_EXTENSION),
                ]);

                $request->image_url->storeAs('public/images/admins', $admin->image_url);
            }

            $old_password = $request->old_password;

            $current_password = $admin->password;

            if ($request->filled('password')) {

                if (!Hash::check($old_password, $current_password)) {

                    connectify('error', 'Invalid Password', 'Invalid Password, Please Enter Correct Password.');

                    return redirect(route('admin.profile'));

                } else {

                    $new_password = bcrypt($request->password);
                    $admin->update([
                        'password' => $new_password,
                    ]);

                }
            }

            $admin->update([
                'name' => $request->name,
            ]);

            connectify('success', 'Profile Updated', 'Profile has been updated successfully !');

            return redirect(route('admin.profile'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, Account Not Found !');

                return redirect(route('admin.dashboard'));
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end');

            return redirect(route('admin.dashboard'));
        }
    }

}
