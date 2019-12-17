<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\Staff;
use App\Model\TxnLogistic;
use App\Model\TxnOrder;
use App\Model\TxnShipping;
use App\Model\TxnUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        $admins = Admin::count();
        $users = TxnUser::count();
        $subscribers = TxnUser::where('is_subcribed', true)->count();
        $today_users = TxnUser::whereDate('created_at', \Carbon\Carbon::today())->count();
        $todays_sales = TxnOrder::where('status', 'Booked')->whereDate('created_at', \Carbon\Carbon::today())->sum('total');
        $pending_shippings = TxnOrder::where('status', 'Booked')->count();
        $orders = TxnOrder::whereNotIn('status', ['nc', 'pending', 'returned'])->count();
        // $month_orders  = TxnOrder::where('status', 'Booked')->whereMonth('created_at', \Carbon\Carbon::today())->sum('total');
        return view('adminauth.index', compact(['admins', 'pending_shippings', 'todays_sales', 'users', 'today_users',  'orders', 'subscribers']));
    }

    public function profile()
    {
        return view('adminauth.edit')->with('admin', auth('admin')->user());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'password' => 'required|string|max:191',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect(route('admin.admins.all'))->with('messageSuccess', 'Admin has been added successfully 1');
    }

    public function edit($id)
    {
        try {

            $admin = Admin::where('id', $id)->firstOrFail();
            return view('adminauth.edit', compact('admin'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.admins.all'))->with('messageDanger', 'Whoops, Admin Not Found with id : ' . $id);
            }
            return redirect(route('admin.admins.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
        ]);

        try {
            $admin = Admin::where('id', auth()->user()->id)->firstOrFail();

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

            if ($request->filled('status')) {
                $admin->update([
                    'status' => $request->status,
                ]);
            }

            $admin->update([
                'name' => $request->name,
            ]);

            return redirect(route('admin.admins.edit', $admin->id))->with('messageSuccess', 'Profile has been updated successfully !');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.admins.edit', $admin->id))->with('messageDanger', 'Whoops, Something Went Wrong !');
            }
            return redirect(route('admin.admins.edit', $admin->id))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    public function manage()
    {
        $admins = Admin::get();
        return view('adminauth.manage', compact('admins'));
    }

    public function destroy($id)
    {
        try {
            $admin = Admin::where('id', $id)->firstOrFail();

            if ($admin->super_admin == 1) {
                return redirect(route('admin.admins.all'))->with('messageDanger', 'Whoops, Can not delete super admin');
            }

            if ($admin->image_url) {
                $old_image = public_path("/storage/images/admins/" . $admin->image_url);
                if (File::exists($old_image)) {
                    File::delete($old_image);
                }
            }

            $admin->delete();

            return redirect(route('admin.admins.all'))->with('messageSuccess', 'Admin has been removed successfully !');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.admins.all'))->with('messageDanger', 'Whoops, Soething Went Wrong !');
            }
            return redirect(route('admin.admins.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    public function addUserForm()
    {
        return view('backend.admin.users.add-user');
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'password' => 'required|string|max:191',
            'user_type' => 'required|string',
        ],
            [
                'name.required' => 'Please Enter Name',
                'email.required' => 'Please Enter Email ID',
                'email.email' => 'Please Enter Proper Email ID',
                'email.unique' => $request->email . ' Already Registered',
                'password.required' => 'Please Enter Password',
                'user_type.required' => 'Please Select user type ',
            ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => true,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ];

        switch ($request->user_type) {
            case 'admin':
                $request->validate([
                    'email' => 'unique:admins,email',
                ],
                    [
                        'email.unique' => $request->email . ' Already Registered',

                    ]);
                Admin::insert($data);
                break;

            case 'manager':
                $request->validate([
                    'email' => 'unique:staff,email',
                ],
                    [
                        'email.unique' => $request->email . ' Already Registered',

                    ]);
                Staff::insert($data);
                break;

            case 'logistic':
                $request->validate([
                    'email' => 'unique:txn_logistics,email',
                ],
                    [
                        'email.unique' => $request->email . ' Already Registered',

                    ]);
                TxnLogistic::insert($data);
                break;

            default:
                return redirect(route('admin.add.user'))->with('messageDanger', 'Can Not Add user, try again later');
                break;
        }

        return redirect(route('admin.add.user'))->with('messageSuccess', $request->user_type . ' has been added successfully');
    }
}
