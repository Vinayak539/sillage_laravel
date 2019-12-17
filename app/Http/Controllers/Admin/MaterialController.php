<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\TxnMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = TxnMaterial::paginate(50);
        return view('backend.admin.materials.index', compact('materials'));
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
            'material_name' => 'required|string|unique:txn_materials,material_name',
        ],
            [
                'material_name.required' => 'Please Enter Material',
                'material_name.unique' => $request->material_name . ' Material Already Available',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Add Material', $validator->errors()->first());
            return redirect(route('admin.materials.all'))->withInput();
        }

        TxnMaterial::create([
            'material_name' => $request->material_name,
            'status' => true,
        ]);

        connectify('success', 'Material Added', 'Material has been added successfully !');

        return redirect(route('admin.materials.all'));
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

            $material = TxnMaterial::where('id', $id)->firstOrFail();
            return view('backend.admin.materials.edit', compact('material'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Material Updated', 'Whoops, Material Not Found !');

                return redirect(route('admin.materials.all'));
            }

            Log::error(['Edit Material' => $ex->getMessage()]);

            connectify('error', 'Material Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.materials.all'));
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
            'material_name' => 'required|string',
            'status' => 'required|integer|max:1',
        ],
            [
                'material_name.required' => 'Please Enter Material',
                'status.required' => 'Please Enter Brand Status',
                'status.max' => 'Invalid Data Provided',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Material Update', $validator->errors()->first());
            return redirect(route('admin.materials.edit', $id))->withInput();
        }

        try {

            $material = TxnMaterial::where('id', $id)->firstOrFail();

            $material->update([
                'material_name' => $request->material_name,
                'status' => $request->status,
            ]);

            connectify('success', 'Material Updated', 'Material has been Updated Successfully');

            return redirect(route('admin.materials.all'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Material Updated', 'Whoops, Material Not Found !');

                return redirect(route('admin.materials.all'));
            }

            Log::error(['Edit Material' => $ex->getMessage()]);

            connectify('error', 'Material Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.materials.all'));
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

            $material = TxnMaterial::where('id', $id)->firstOrFail();
            $material->delete();
            return redirect(route('admin.materials.all'))->with('messageSuccess', 'Material has been deleted successfully !');

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.materials.all'))->with('messageDanger', 'Whoops, Material Not Found with id : ' . $id);
            }
            return redirect(route('admin.materials.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }
}
