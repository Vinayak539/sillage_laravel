<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\TxnOrder;
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
        $admins            = Admin::count();
        $users             = TxnUser::count();
        $subscribers       = TxnUser::where('is_subcribed', true)->count();
        $today_users       = TxnUser::whereDate('created_at', \Carbon\Carbon::today())->count();
        $todays_sales      = TxnOrder::where('status', 'Booked')->whereDate('created_at', \Carbon\Carbon::today())->sum('total');
        $pending_shippings = TxnOrder::where('status', 'Booked')->count();
        $orders            = TxnOrder::whereNotIn('status', ['nc', 'pending', 'returned'])->count();
        // $month_orders  = TxnOrder::where('status', 'Booked')->whereMonth('created_at', \Carbon\Carbon::today())->sum('total');
        return view('adminauth.index', compact(['admins', 'pending_shippings', 'todays_sales', 'users', 'today_users', 'orders', 'subscribers']));
    }

    public function profile()
    {
        return view('adminauth.edit')->with('admin', auth('admin')->user());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:191',
            'email'    => 'required|email|max:191',
            'password' => 'required|string|max:191',
        ]);

        Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        connectify('success', 'Admin Added', 'Admin has been added successfully 1');

        return redirect(route('admin.admins.all'));
    }

    public function edit($id)
    {
        try {

            $admin = Admin::where('id', $id)->firstOrFail();
            return view('adminauth.edit', compact('admin'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, Account Not Found !');

                return redirect(route('admin.admins.all'));
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end');

            return redirect(route('admin.admins.all'));
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

            connectify('success', 'Profile Updated', 'Profile has been updated successfully !');

            return redirect(route('admin.admins.edit', $admin->id));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, Account Not Found !');

                return redirect(route('admin.admins.all'));
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end');

            return redirect(route('admin.admins.all'));
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

            connectify('success', 'Admin Delete', 'Admin has been removed successfully !');

            return redirect(route('admin.admins.all'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, Account Not Found !');

                return redirect(route('admin.admins.all'));
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end');

            return redirect(route('admin.admins.all'));
        }
    }

}
