<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\TxnWeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = TxnWeight::paginate(50);
        return view('backend.admin.units.index', compact('units'));
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
            'unit' => 'required|string|max:50|unique:txn_weights,unit',
        ],
            [
                'unit.required' => 'Please Enter Unit Name',
                'unit.max' => 'Please Enter Unit Name in Maximum 50 Character',
                'unit.unique' => $request->unit . ' Unit Already Available',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Add Unit', $validator->errors()->first());
            return redirect(route('admin.units.all'))->withInput();
        }

        TxnWeight::create([
            'unit' => $request->unit,
            'status' => true,
        ]);

        connectify('success', 'Unit Added', 'Unit has been added successfully !');

        return redirect(route('admin.units.all'));
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

            $unit = TxnWeight::where('id', $id)->firstOrFail();
            return view('backend.admin.units.edit', compact('unit'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Unit Updated', 'Whoops, Unit Not Found !');

                return redirect(route('admin.units.all'));
            }

            Log::error(['Edit Unit' => $ex->getMessage()]);

            connectify('error', 'Unit Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.units.all'));
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
            'unit' => 'required|string',
            'status' => 'required|integer|max:1',
        ],
            [
                'unit.required' => 'Please Enter Unit',
                'status.required' => 'Please Enter Unit Status',
                'status.max' => 'Invalid Data Provided',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Unit Update', $validator->errors()->first());
            return redirect(route('admin.units.edit', $id))->withInput();
        }

        try {

            $unit = TxnWeight::where('id', $id)->firstOrFail();

            $unit->update([
                'unit' => $request->unit,
                'status' => $request->status,
            ]);

            connectify('success', 'Unit Updated', 'Unit has been Updated successfully');

            return redirect(route('admin.units.all'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Unit Updated', 'Whoops, Unit Not Found !');

                return redirect(route('admin.units.all'));
            }

            Log::error(['Edit Unit' => $ex->getMessage()]);

            connectify('error', 'Unit Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.units.all'));
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

            $unit = TxnWeight::where('id', $id)->firstOrFail();
            $unit->delete();
            return redirect(route('admin.units.all'))->with('messageSuccess', 'Unit has been deleted successfully !');

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.units.all'))->with('messageDanger', 'Whoops, Unit Not Found with id : ' . $id);
            }
            return redirect(route('admin.units.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }
}
