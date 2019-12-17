<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\TxnCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conditions = TxnCondition::orderBy('id', 'DESC')->paginate(50);
        return view('backend.admin.conditions.index', compact('conditions'));
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
            'condition' => 'required|string|max:50|unique:txn_conditions,condition',
        ],
            [
                'condition.required' => 'Please Enter Condition',
                'condition.max' => 'Please Enter Condition in Maximum 50 Character',
                'condition.unique' => $request->condition . ' Condition Already Available',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Add Condition', $validator->errors()->first());
            return redirect(route('admin.conditions.all'))->withInput();
        }

        TxnCondition::create([
            'condition' => $request->condition,
            'status' => true,
        ]);

        connectify('success', 'Condition Added', 'Condition has been Added Successfully ');

        return redirect(route('admin.conditions.all'));
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

            $condition = TxnCondition::where('id', $id)->firstOrFail();
            return view('backend.admin.conditions.edit', compact('condition'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Condition Updated', 'Whoops, Condition Not Found !');

                return redirect(route('admin.conditions.all'));
            }

            Log::error(['Edit Condition' => $ex->getMessage()]);

            connectify('error', 'Condition Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.conditions.all'));
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
            'condition' => 'required|string|max:50',
            'status' => 'required|numeric|max:1',
        ],
            [
                'condition.required' => 'Please Enter Condition',
                'status.required' => 'Select Status',
                'status.max' => 'Invalid Status Provided !',
            ]);

        $validator = Validator::make($request->all(), [
            'condition' => 'required|string|max:50',
            'status' => 'required|numeric|max:1',
        ],
            [
                'condition.required' => 'Please Enter Condition',
                'status.required' => 'Select Status',
                'status.max' => 'Invalid Status Provided !',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Condition Update', $validator->errors()->first());
            return redirect(route('admin.conditions.edit', $id))->withInput();
        }

        try {

            $condition = TxnCondition::where('id', $id)->firstOrFail();

            $condition->update([
                'condition' => $request->condition,
                'status' => $request->status,
            ]);

            connectify('success', 'Condition Updated', 'Condition has been Updated Successfully');

            return redirect(route('admin.conditions.all'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Condition Updated', 'Whoops, Condition Not Found !');

                return redirect(route('admin.conditions.all'));
            }

            Log::error(['Update Condition' => $ex->getMessage()]);

            connectify('error', 'Condition Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.conditions.all'));
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
}
