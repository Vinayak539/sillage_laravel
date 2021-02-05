<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\BulkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BulkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquiries = BulkOrder::orderBy('id', 'DESC')->paginate(50);
        return view('backend.admin.bulk-orders.index', compact('enquiries'));
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
            'name'    => 'required|string|max:191',
            'mobile'  => 'required|digits_between:8,12',
            'email'   => 'required|email|max:191',
            'message' => 'required|string',
        ],
            [
                'name.required'         => 'Please Enter Your Name',
                'mobile.required'       => 'Please Enter Your Mobile Number',
                'mobile.digits_between' => 'Please Enter Mobile Number in digits between 8 to 12',
                'email.required'        => 'Please Enter Email ID',
                'email.email'           => 'Please Enter Proper Email ID',
                'message.required'      => 'Please Enter Message',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Error', $validator->errors()->first());
            return back()->withInput();
        }

        $data = BulkOrder::create([
            'name'    => $request->name,
            'mobile'  => $request->mobile,
            'email'   => $request->email,
            'message' => $request->message,
        ]);

        Mail::send(['html' => 'backend.mails.enquiry'], ['data' => $data], function ($message) {
            $message->from('contact@sillageniche.com', 'SILLAGE');
            $message->to('contact@sillageniche.com', 'SILLAGE');
            $message->subject('New Bulk Order Enquiry From SILLAGE');
        });
        
        connectify('success', 'Enquiry Success', 'Thank you for contacting us, we\'ll get back to you soon !');

        return back();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\BulkOrder  $bulkOrder
     * @return \Illuminate\Http\Response
     */
    public function show(BulkOrder $bulkOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\BulkOrder  $bulkOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(BulkOrder $bulkOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\BulkOrder  $bulkOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BulkOrder $bulkOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\BulkOrder  $bulkOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(BulkOrder $bulkOrder)
    {
        //
    }
}
