<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\TxnUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

            $user = TxnUser::where('id', $id)->with('orders')->firstOrFail();
            return view('backend.admin.users.orders', compact('user'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.users.all'))->with('messageDanger', 'Whoops, User Not Found !');
            }
            return redirect(route('admin.users.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    public function edit($id)
    {
        try {

            $user = TxnUser::where('id', $id)->firstOrFail();
            return view('backend.admin.users.edit', compact('user'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.users.all'))->with('messageDanger', 'Whoops, User Not Found !');
            }
            return redirect(route('admin.users.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    public function show($id)
    {
        try {

            $user = TxnUser::where('id', $id)->firstOrFail();
            return view('backend.admin.users.show', compact('user'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.users.all'))->with('messageDanger', 'Whoops, User Not Found !');
            }
            return redirect(route('admin.users.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status'    => 'required|string|max:191',
        ]);

        try {

            $user = TxnUser::where('id', $id)->firstOrFail();

            $user->update([
                'status' => $request->status,
            ]);

            return redirect(route('admin.users.edit', $user->id))->with('messageSuccess', 'Data has been updated successfully !');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.users.all'))->with('messageDanger', 'Whoops, User Not Found !');
            }
            return redirect(route('admin.users.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    public function reviews($id)
    {
        try {

            $user = TxnUser::where('id', $id)->with('reviews')->firstOrFail();
            return view('backend.admin.users.reviews', compact('user'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.users.all'))->with('messageDanger', 'Whoops, User Not Found !');
            }
            return redirect(route('admin.users.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
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

    public function block($id)
    {
        try {

            $user = TxnUser::where('id', $id)->firstOrFail();

            $user->update([
                'status' => false,
            ]);

            return redirect(route('admin.users.all'))->with('messageSuccess', 'You have Blocked user ' . '"' . $user->name . '"');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.users.all'))->with('messageDanger', 'Whoops, User Not Found !');
            }
            return redirect(route('admin.users.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    public function unblock($id)
    {
        try {

            $user = TxnUser::where('id', $id)->firstOrFail();

            $user->update([
                'status' => true,
            ]);

            return redirect(route('admin.users.all'))->with('messageSuccess', 'You have Unblocked user ' . '"' . $user->name . '"');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.users.all'))->with('messageDanger', 'Whoops, User Not Found !');
            }
            return redirect(route('admin.users.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }
}
