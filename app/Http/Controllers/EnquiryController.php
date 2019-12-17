<?php

namespace App\Http\Controllers;

use App\Model\Enquiry;
use App\Model\TxnContactUs;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;
use Mail;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = TxnContactUs::orderBy('id', 'DESC')->paginate(50);
        return view('backend.admin.enquiries.index', compact('enquiries'));
    }

    public function create()
    {
        return view('frontend.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:191',
            'mobile'  => 'required|digits_between:8,12',
            'subject' => 'required|string|max:191',
            'email'   => 'required|email|max:191',
            'message' => 'required|string',
        ],
            [
                'name.required'         => 'Please Enter Your Name',
                'mobile.required'       => 'Please Enter Your Mobile Number',
                'mobile.digits_between' => 'Please Enter Mobile Number in digits between 8 to 12',
                'subject.required'      => 'Please Enter Subject',
                'email.required'        => 'Please Enter Email ID',
                'email.email'           => 'Please Enter Proper Email ID',
                'message.required'      => 'Please Enter Message',
            ]);

        $data = TxnContactUs::create([
            'name'    => $request->name,
            'mobile'  => $request->mobile,
            'subject' => $request->subject,
            'email'   => $request->email,
            'message' => $request->message,
        ]);
        
        Mail::send(['html' => 'backend.mails.enquiry'], ['data' => $data], function ($message) {
            $message->from('contact@thehatkestore.com', 'Thehatkestore');
            $message->to('contact@thehatkestore.com', 'Thehatkestore');
            $message->subject('New Enquiry From Thehatkestore');
        });

        return redirect(route('contact'))->with('messageSuccess', 'Thank you for contacting us, we\'ll get back to you soon..');
    }
}
