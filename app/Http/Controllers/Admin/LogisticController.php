<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\TxnLogistic;
use Illuminate\Http\Request;

class LogisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logistics = TxnLogistic::orderBy('id')->paginate(50);
        return view('backend.admin.logistics.index', compact('logistics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:txn_logistics,email',
            'password' => 'required|string|max:191',
        ],
            [
                'name.required' => 'Please Enter Name',
                'email.required' => 'Please Enter Email ID',
                'email.unique' => 'Email is already Registered',
                'password.required' => 'Please Enter Password',
            ]);

        TxnLogistic::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => true,
        ]);

        return redirect(route('admin.logistics.all'))->with('messageSuccess', 'Logistic has been added successfully !');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $logistic = TxnLogistic::where('id', $id)->firstOrFail();
            return view('backend.admin.logistics.edit', compact('logistic'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.logistics.all'))->with('messageDanger', 'Whoops, Logistic Not Found !');
            }
            return redirect(route('admin.logistics.all'))->with('messageDanger', 'Whoops, Something Went Wrong From our End');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'status' => 'required|max:1',
        ],
            [
                'name.required' => 'Please Enter Name',
                'status.required' => 'Please Enter Status',
                'status.max' => 'Invalid Status given',
            ]);

        try {

            $logistic = TxnLogistic::where('id', $id)->firstOrFail();

            $logistic->update([
                'name' => $request->name,
                'status' => $request->status,
            ]);

            if ($request->filled('password')) {
                $logistic->update([
                    'password' => bcrypt($request->password),
                ]);
            }

            return redirect(route('admin.logistics.edit', $id))->with('messageSuccess', 'Logistic has been Updated successfully !');
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.logistics.all'))->with('messageDanger', 'Whoops, Logistic Not Found !');
            }
            return redirect(route('admin.logistics.all'))->with('messageDanger', 'Whoops, Something Went Wrong From our End');
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
        try {

            $logistic = TxnLogistic::where('id', $id)->firstOrFail();
            $logistic->delete();
            return redirect(route('admin.logistics.all'))->with('messageSuccess', 'Logistic has been Deleted successfully !');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.logistics.all'))->with('messageDanger', 'Whoops, Logistic Not Found !');
            }
            return redirect(route('admin.logistics.all'))->with('messageDanger', 'Whoops, Something Went Wrong From our End');
        }
    }
}
