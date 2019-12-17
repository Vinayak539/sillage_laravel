<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\MasterWarranty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WarrantyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warranties = MasterWarranty::paginate(50);
        return view('backend.admin.warranties.index', compact('warranties'));
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

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50|unique:master_warranties,title',
        ],
            [
                'title.required' => 'Please Enter Warranty Title',
                'title.max' => 'Please Enter Warranty Title in Maximum 50 Character',
                'title.unique' => $request->title . ' Warranty Already Available',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Add Warranty', $validator->errors()->first());
            return redirect(route('admin.warranties.all'))->withInput();
        }

        MasterWarranty::create([
            'title' => $request->title,
            'status' => true,
        ]);

        connectify('success', 'Warranty Added', 'Warranty has been added successfully !');

        return redirect(route('admin.warranties.all'));
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

            $warranty = MasterWarranty::where('id', $id)->firstOrFail();
            return view('backend.admin.warranties.edit', compact('warranty'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Warranty Updated', 'Whoops, Warranty Not Found !');

                return redirect(route('admin.warranties.all'));
            }

            Log::error(['Edit Warranty' => $ex->getMessage()]);

            connectify('error', 'Warranty Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.warranties.all'));
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

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'status' => 'required|integer|max:1',
        ],
            [
                'title.required' => 'Please Enter Title',
                'status.required' => 'Please Enter Warranty Status',
                'status.max' => 'Invalid Data Provided',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Warranty Update', $validator->errors()->first());
            return redirect(route('admin.warranties.edit', $id))->withInput();
        }

        try {

            $warranty = MasterWarranty::where('id', $id)->firstOrFail();

            $warranty->update([
                'title' => $request->title,
                'status' => $request->status,
            ]);

            connectify('success', 'Warranty Updated', 'Warranty has been Updated successfully');

            return redirect(route('admin.warranties.all'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Warranty Updated', 'Whoops, Warranty Not Found !');

                return redirect(route('admin.warranties.all'));
            }

            Log::error(['Edit Warranty' => $ex->getMessage()]);

            connectify('error', 'Warranty Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.warranties.all'));
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

            $warranty = MasterWarranty::where('id', $id)->firstOrFail();
            $warranty->delete();
            return redirect(route('admin.warranties.all'))->with('messageSuccess', 'warranty has been deleted successfully !');

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Warranty Updated', 'Whoops, Warranty Not Found !');

                return redirect(route('admin.warranties.all'));
            }

            Log::error(['Edit Warranty' => $ex->getMessage()]);

            connectify('error', 'Warranty Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.warranties.all'));
        }
    }
}
