<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendNewsletterJob;
use App\Model\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subscribers = Subscriber::orderBy('id', 'DESC')->get();
        return view('backend.admin.subscribers.index', compact('subscribers'));

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->validate([
            'sendEmail' => 'required',
        ],
            [
                'sendEmail.required' => 'Please Select Atleast One Email ID',
                'sendEmail.exists'   => 'The Email is not Valid',
            ]);

        return view('backend.admin.subscribers.send')->with(['sendEmails' => $request->sendEmail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        //
    }

    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sendEmail' => 'required|array',
            'sendEmail' => 'email',
            'message'   => 'required|string',
        ],
            [
                'email.*.exists'   => 'Email is Not Valid',
                'message.required' => 'Please Enter Message',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Send Newsletter', $validator->errors()->first());
            return back()->withInput();
        }

        foreach ($request->emails as $email) {
            $data = [
                'email'       => $email,
                'bodyMessage' => $request->message,
                'encrypt_email' => Crypt::encryptString($email)
            ];

            $this->dispatch(new SendNewsletterJob($data));
        }

        connectify('success', 'Send Newsletter', 'Newsletters Send Successfully !');

        return redirect(route('admin.subscribers.all'));
    }

    public function unsubscribe($email)
    {
        try {

            $newsletter = Subscriber::where('email', Crypt::decryptString($email))->firstOrFail();

            $newsletter->update([
                'status' => false,
            ]);

            connectify('success', 'Unsubscribed', 'You have been unsubscribed successfully, you can subscribe anytime by putting your email in Newsletter');

            return redirect(url('/'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Email Not Found !');
                return redirect(url('/'));
            }

            connectify('error', 'Error', 'Whoops, Something went wrong from our end !');

            return redirect(url('/'));

        }
    }
}
