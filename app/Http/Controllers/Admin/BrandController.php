<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\TxnBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = TxnBrand::paginate(50);
        return view('backend.admin.brands.index', compact('brands'));
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
            'name' => 'required|string|max:50|unique:txn_brands,brand_name',
        ],
            [
                'name.required' => 'Please Enter Brand Name',
                'name.max' => 'Please Enter Brand Name in Maximum 50 Character',
                'name.unique' => $request->name . ' brand Already Available',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Add Brand', $validator->errors()->first());
            return redirect(route('admin.brands.all'))->withInput();
        }

        TxnBrand::create([
            'brand_name' => $request->name,
            'status' => true,
        ]);

        connectify('success', 'Brand Added', 'Brand has been added successfully !');

        return redirect(route('admin.brands.all'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $brand = TxnBrand::where('id', $id)->firstOrFail();
            return view('backend.admin.brands.edit', compact('brand'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Brand Updated', 'Whoops, Brand Not Found !');

                return redirect(route('admin.brands.all'));
            }

            Log::error(['Edit Brand' => $ex->getMessage()]);

            connectify('error', 'Brand Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.brands.all'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'status' => 'required|integer|max:1',
        ],
            [
                'name.required' => 'Please Enter Brand Name',
                'name.max' => 'Please Enter Brand Name in Maximum 50 Character',
                'status.required' => 'Please Enter Brand Status',
                'status.max' => 'Invalid Data Provided',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Brand Update', $validator->errors()->first());
            return redirect(route('admin.brands.edit', $id))->withInput();
        }

        try {

            $brand = TxnBrand::where('id', $id)->firstOrFail();

            $brand->update([
                'brand_name' => $request->name,
                'status' => $request->status,
            ]);

            connectify('success', 'Brand Updated', 'Brand has been Updated successfully');

            return redirect(route('admin.brands.all'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Update Brand', 'Whoops, Brand Not Found !');

                return redirect(route('admin.brands.all'));
            }

            Log::error(['Edit Brand' => $ex->getMessage()]);

            connectify('error', 'Update Brand', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.brands.all'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $brand = TxnBrand::where('id', $id)->firstOrFail();
            $brand->delete();
            return redirect(route('admin.brands.all'))->with('messageSuccess', 'Brand has been deleted successfully !');

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.brands.all'))->with('messageDanger', 'Whoops, Brand Not Found with id : ' . $id);
            }
            return redirect(route('admin.brands.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }
}
