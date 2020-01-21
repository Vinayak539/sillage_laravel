<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\TxnUser;
use Illuminate\Http\Request;

class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = TxnUser::orderBy('id', 'DESC')->paginate(50);
        return view('backend.admin.users.index', compact('users'));
    }

    public function orders($id)
    {
        try {

            $user = TxnUser::where('id', $id)->with(['orders' => function ($q) {
                $q->whereNotIn('status', ['nc'])->orderBy('id', 'DESC')->get();
            }])->firstOrFail();

            return view('backend.admin.users.orders', compact('user'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, User Not Found !');

                return redirect(route('admin.users.all'));
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.users.all'));
        }
    }

    public function edit($id)
    {
        try {

            $user = TxnUser::where('id', $id)->firstOrFail();
            return view('backend.admin.users.edit', compact('user'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, User Not Found !');

                return redirect(route('admin.users.all'));
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.users.all'));
        }
    }

    public function show($id)
    {
        try {

            $user = TxnUser::where('id', $id)->firstOrFail();
            return view('backend.admin.users.show', compact('user'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, User Not Found !');

                return redirect(route('admin.users.all'));
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.users.all'));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:191',
        ]);

        try {

            $user = TxnUser::where('id', $id)->firstOrFail();

            $user->update([
                'status' => $request->status,
            ]);

            $status = $user->status == true ? "Active" : "Blocked";

            connectify('success', 'Status Updated', $user->name . ' Status changed to ' . $status);

            return redirect(route('admin.users.edit', $user->id));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, User Not Found !');

                return redirect(route('admin.users.all'));
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.users.all'));
        }
    }

    
    public function addresses($id)
    {
        try {

            $user = TxnUser::where('id', $id)->with('addresses')->firstOrFail();

            return view('backend.admin.users.addresses', compact('user'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, User Not Found !');

                return redirect(route('admin.users.all'));
            }

            return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.users.all'));
        }
    }

    public function reviews($id)
    {
        try {

            $user = TxnUser::where('id', $id)->with('reviews')->firstOrFail();
            return view('backend.admin.users.reviews', compact('user'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, User Not Found !');

                return redirect(route('admin.users.all'));
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.users.all'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function block(Request $request)
    {
        try {

            $user = TxnUser::where('id', $request->user_id)->firstOrFail();

            $user->update([
                'status' => false,
            ]);

            connectify('success', 'Blocked', 'You have Blocked user ' . '"' . $user->name . '"');

            return redirect(route('admin.users.all'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, User Not Found !');

                return redirect(route('admin.users.all'));
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.users.all'));
        }
    }

    public function unblock(Request $request)
    {
        try {

            $user = TxnUser::where('id', $request->user_id)->firstOrFail();

            $user->update([
                'status' => true,
            ]);

            connectify('success', 'Unblocked', 'You have Unblocked user ' . '"' . $user->name . '"');

            return redirect(route('admin.users.all'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, User Not Found !');

                return redirect(route('admin.users.all'));
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.users.all'));
        }
    }
}
