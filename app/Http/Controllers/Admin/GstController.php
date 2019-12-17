<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\TxnMasterGst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GstController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gsts = TxnMasterGst::orderBy('gst_value')->paginate(50);
        return view('backend.admin.gsts.index', compact('gsts'));
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
            'gst_value' => 'required|integer|digits_between:1,2|unique:txn_master_gsts,gst_value',
        ],
            [
                'gst_value.required' => 'Please Enter GST',
                'gst_value.digits_between' => 'Please Enter GST in between 1 to 2',
                'gst_value.unique' => $request->gst_value . ' GST Already Available',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Add GST', $validator->errors()->first());
            return redirect(route('admin.gsts.all'))->withInput();
        }

        TxnMasterGst::create([
            'gst_value' => $request->gst_value,
            'status' => true,
        ]);

        connectify('success', 'GST Added', 'GST has been added successfully !');

        return redirect(route('admin.gsts.all'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\TxnMasterGst  $txnMasterGst
     * @return \Illuminate\Http\Response
     */
    public function show(TxnMasterGst $txnMasterGst)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\TxnMasterGst  $txnMasterGst
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $gst = TxnMasterGst::where('id', $id)->firstOrFail();
            return view('backend.admin.gsts.edit', compact('gst'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'GST Updated', 'Whoops, GST Not Found !');

                return redirect(route('admin.gsts.all'));
            }

            Log::error(['Edit GST' => $ex->getMessage()]);

            connectify('error', 'GST Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.gsts.all'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\TxnMasterGst  $txnMasterGst
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'gst_value' => 'required|string|max:50',
            'status' => 'required|integer|digits_between:1,2',
        ],
            [
                'gst_value.required' => 'Please Enter GST',
                'gst_value.digits_between' => 'Please Enter GST in between 1 to 2',
                'status.required' => 'Please Enter GST Status',
                'status.max' => 'Invalid Data Provided',
            ]);

        $validator = Validator::make($request->all(), [
            'gst_value' => 'required|string|max:50',
            'status' => 'required|integer|digits_between:1,2',
        ],
            [
                'gst_value.required' => 'Please Enter GST',
                'gst_value.digits_between' => 'Please Enter GST in between 1 to 2',
                'status.required' => 'Please Enter GST Status',
                'status.max' => 'Invalid Data Provided',
            ]);

        if ($validator->fails()) {
            connectify('error', 'GST Update', $validator->errors()->first());
            return redirect(route('admin.gsts.edit', $id))->withInput();
        }

        try {

            $gst = TxnMasterGst::where('id', $id)->firstOrFail();

            $gst->update([
                'gst_value' => $request->gst_value,
                'status' => $request->status,
            ]);

            connectify('success', 'GST Updated', 'GST has been Updated successfully');

            return redirect(route('admin.gsts.all'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'GST Updated', 'Whoops, GST Not Found !');

                return redirect(route('admin.gsts.all'));
            }

            Log::error(['Edit GST' => $ex->getMessage()]);

            connectify('error', 'GST Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.gsts.all'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\TxnMasterGst  $txnMasterGst
     * @return \Illuminate\Http\Response
     */
    public function destroy(TxnMasterGst $txnMasterGst)
    {
        //
    }
}
