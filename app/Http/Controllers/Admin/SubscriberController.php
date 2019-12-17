<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendNewsletterJob;
use App\Model\Subscriber;
use App\Model\TxnUser;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subscribers = TxnUser::where('is_subcribed', true)->orderBy('id', 'DESC');

        if ($request->filled('city')) {
            $subscribers = $subscribers->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('pincode')) {
            $subscribers = $subscribers->where('pincode', 'like', '%' . $request->pincode . '%');
        }

        if ($request->filled('territory')) {
            $subscribers = $subscribers->where('territory', 'like', '%' . $request->territory . '%');
        }

        $subscribers = $subscribers->get();
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
        $request->validate([
            'sendEmail' => 'required|array',
            'sendEmail' => 'email',
            'message'   => 'required|string',
        ],
            [
                'email.*.exists'   => 'Email is Not Valid',
                'message.required' => 'Please Enter Message',
            ]);

        foreach ($request->emails as $email) {
            $data = [
                'email'       => $email,
                'bodyMessage' => $request->message,
            ];

            $this->dispatch(new SendNewsletterJob($data));
        }

        return redirect(route('admin.subscribers.all'))->with('messageSuccess', 'Newsletters Send Successfully !');
    }

    public function unsubscribe($email)
    {
        try {
            $newsletter = TxnUser::where('email', $email)->firstOrFail();
            $newsletter->update([
                'is_subcribed' => false,
            ]);
            return redirect(url('/'))->with('messageSuccess1', 'You have been unsubscribed successfully, you can subscribe anytime by putting your email in Newsletter');
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(url('/'))->with('messageDanger1', 'Whoops, Something went wrong !');
            } else {
                return redirect(url('/'))->with('messageDanger1', 'Whoops, Something went wrong from our end !');

            }
        }
    }
}
