<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Returnticket;
use App\Model\SMS;
use App\Model\Ticket;
use App\Model\TxnOrder;
use App\Model\TxnReview;
use App\Model\TxnUser;
use App\Model\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $user = TxnUser::where('id', auth('user')->user()->id)->with(['orders' => function ($q) {
                $q->where('status', '<>', 'nc')->orderBy('id', 'DESC')->get();
            }])->firstOrFail();

            return view('frontend.user.index', compact('user'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Something Went Wrong !');
                return redirect('/');
            }
            // return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something went wrong from our end !');

            return redirect('/');
        }

    }

    public function showMyAccount()
    {
        try {
            $user = TxnUser::where('id', auth('user')->user()->id)->firstOrFail();

            return view('frontend.user.profile', compact('user'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Something Went Wrong !');
                return redirect('/');
            }
            // return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something went wrong from our end !');

            return redirect('/');
        }
    }

    public function showChangePassword()
    {
        try {
            $user = TxnUser::where('id', auth('user')->user()->id)->firstOrFail();

            return view('frontend.user.change-password', compact('user'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Something Went Wrong !');
                return redirect('/');
            }
            // return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something went wrong from our end !');

            return redirect('/');
        }
    }

    public function showOrder()
    {
        try {
            $user = TxnUser::where('id', auth('user')->user()->id)->with(['orders' => function ($q) {
                $q->where('status', '<>', 'nc')->get();
            }])->firstOrFail();
            return view('frontend.user.orders', compact('user'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Something Went Wrong !');
                return redirect(route('user.dashboard'));
            }
            // return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something went wrong from our end !');

            return redirect(route('user.dashboard'));
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'mobile' => 'required|digits_between:10,12',
            'city' => 'required|string|max:191',
            'territory' => 'required|string|max:191',
            'address' => 'required|string',
            'pincode' => 'required|digits:6',
        ],
            [
                'name.required' => 'Please Enter Name',
                'mobile.required' => 'Please Enter Mobile Number',
                'mobile.digits_between' => 'Mobile Number should be between 10 to 12 digits',
                'city.required' => 'Please Enter City',
                'territory.required' => 'Please Enter State',
                'address.required' => 'Please Enter Address',
                'pincode.required' => 'Please Enter Pincode',
                'pincode.digits' => 'Pincode should be of 6 digits',
            ]);

        try {
            $user = TxnUser::where('id', auth('user')->user()->id)->firstOrFail();

            $user->update([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'city' => $request->city,
                'address' => $request->address,
                'territory' => $request->territory,
                'pincode' => $request->pincode,
            ]);

            connectify('success', 'Profile Updated', 'Profile has been updated successfully  !');

            return redirect(route('user.profile'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Something Went Wrong !');
                return redirect('/');
            }
            // return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something went wrong from our end !');

            return redirect('/');
        }
    }
    public function updateChangePassword(Request $request)
    {
        $request->validate([
            'password' => 'required_with:con_password|max:191',
            'con_password' => 'required_with:password|max:191',
        ],
            [
                'password.required_with' => 'Please Enter New Password to change password',
                'con_password.required_with' => 'Please Enter Old Password to change password',
            ]);

        try {

            $user = TxnUser::where('id', auth('user')->user()->id)->firstOrFail();

            if ($request->filled('password')) {
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
            }

            connectify('success', 'Password Updated', 'Password has been updated successfully  !');

            return redirect(route('user.dashboard'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Something Went Wrong !');
                return redirect('/');
            }
            // return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something went wrong from our end !');

            return redirect('/');
        }
    }

    public function getOrder($id)
    {
        try {

            $order = TxnOrder::where('id', $id)->with('details', 'user', 'transaction')->firstOrFail();
            return view('frontend.user.view-order', compact('order'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Something Went Wrong !');
                return redirect('/');
            }
            // return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something went wrong from our end !');

            return redirect('/');
        }
    }

    public function returnOrder(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:191',
            'image_url' => 'nullable|image|max:1024|mimes:jpeg,png',
        ],
            [
                'reason.required' => 'Please Select Reason',
                'image_url.image' => 'Please Select Proper Image',
                'image_url.max' => 'Please Select Image of Maximum size 1MB',
                'image_url.mimes' => 'Please Select Image of type JPEG & PNG',
            ]);

        if ($request->reason == 'other') {
            $request->validate([
                'other_reason' => 'required|string|max:500',
            ],
                [
                    'other_reason.required' => 'Please Write Reason',
                    'other_reason.max' => 'Please Write Reason in 500 characters',
                ]);
        }

        try {

            $order = TxnOrder::where('id', $id)->with('user')->firstOrFail();

            if ($request->hasFile('image_url')) {
                $request['img'] = uniqid() . '.' . pathinfo($request->image_url->getClientOriginalName(), PATHINFO_EXTENSION);
                $request->image_url->storeAs('public/images/order-returns', $request->img);
            }

            $order->update([
                'return_status' => 'Applied',
                'cancel_reason' => $request->reason,
                'image_url' => $request->img,
                'other_reason' => $request->other_reason,
            ]);

            $ticket = Returnticket::create([
                'email' => $order->user->email,
                'subject' => 'Return & Refund',
                'open_by' => auth('user')->user()->name,
                'status' => true,
                'description' => 'Applied for Return and Refund against Order ID : ' . $order->id,
            ]);

            SMS::send($order->user->mobile, 'HNI LIFESTYLE - You have applied for Return and Refund against Order ID : ' . $order->id . ', Stay tuned for approval on http://thehatkestore.com/myaccount');

            Mail::send(['html' => 'backend.mails.ticket'], ['ticket' => $ticket], function ($message) use ($ticket) {
                $message->from('support@thehatkestore.com', 'HNI LIFESTYLE');
                $message->to($ticket->email, 'HNI LIFESTYLE');
                $message->bcc('support@thehatkestore.com', 'HNI LIFESTYLE');
                $message->subject('Ranays Store RE:' . $ticket->subject . ' Ticket ID : ' . $ticket->id);
            });

            connectify('success', 'Return Order', 'Order Return applied successfully, stay tuned for approval !');

            return redirect('/myaccount');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Order Not Found, try again later !');
                return redirect('/myaccount');
            }
            // return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end, try again later !');

            return redirect('/myaccount');
        }
    }

    public function cancelOrder(Request $request)
    {
        try {

            $order = TxnOrder::where('id', $request->order_id)->with('user')->firstOrFail();

            $order->update([
                'status' => 'Order Cancel By Buyer',
            ]);

            // SMS::send($order->user->mobile, 'HNI LIFESTYLE - Your Order ID : ' . $order->id . ', has been cancelled successfully,  Login for more detail on http://thehatkestore.com/');

            Mail::send(['html' => 'backend.mails.order-cancel'], ['order' => $order], function ($message) use ($order) {
                $message->to('support@thehatkestore.com')->subject('Order has been Cancelled ! [order id : ' . $order->id . ']');
                $message->from('support@thehatkestore.com', 'HNI LIFESTYLE');
            });
            connectify('success', 'Order Cancel', 'Order Cancelled Successfully !');

            return redirect(route('user.order', $request->order_id));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Order Not Found, try again later !');
                return redirect('/myaccount');
            }
            return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end, try again later !');

            return redirect('/myaccount');
        }
    }

    public function orderHelp(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',
        ],
            [
                'description.required' => 'Please Enter your query',
            ]);
        try {

            $order = TxnOrder::where('id', $id)->with('user')->firstOrFail();

            $ticket = Ticket::create([
                'email' => $order->user->email,
                'subject' => 'Order By : ' . $order->id,
                'description' => $request->description,
                'open_by' => auth('user')->user()->name . ' - Customer',
                'status' => true,
            ]);

            Mail::send(['html' => 'backend.mails.ticket'], ['ticket' => $ticket], function ($message) use ($ticket) {
                $message->from('support@thehatkestore.com', 'HNI LIFESTYLE');
                $message->to($ticket->email, 'HNI LIFESTYLE');
                $message->bcc('support@thehatkestore.com', 'HNI LIFESTYLE');
                $message->subject('Ranays Store' . $ticket->subject . ' Ticket ID : ' . $ticket->id);
            });

            connectify('success', 'Need Help', 'Your query has been sent successfully, our expert will get in touch with you soon, stay tuned !');

            return redirect(route('user.order', $id));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Order Not Found, try again later !');
                return redirect('/myaccount');
            }
            // return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end, try again later !');

            return redirect('/myaccount');
        }
    }

    public function review(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:txn_products,id',
            'rating' => 'required|integer|max:5|min:1',
            'comment' => 'required|string',
        ],
            [
                'product_id.required' => 'Please Select Product',
                'product_id.integer' => 'Invalid data provided',
                'product_id.exists' => 'Product Not Found !',
            ]);

        try {

            $user = TxnUser::where('id', auth('user')->user()->id)->firstOrFail();

            TxnReview::updateOrCreate([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
            ],
                [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'product_id' => $request->product_id,
                    'rating' => $request->rating,
                    'comment' => $request->comment,
                    'status' => false,
                ]
            );

            connectify('success', 'Review Added', 'Thank you for Reviwing our product !');

            return back();

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Order Not Found, try again later !');
                return redirect('/myaccount');
            }
            // return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end, try again later !');

            return redirect('/myaccount');
        }
    }

    public function downloadInvoice($id)
    {
        try {

            $invoice = TxnOrder::where('id', $id)->with('details', 'user', 'transaction')->firstOrFail();

            // return view('backend.admin.invoices.download', compact('invoice'));

            $pdf = PDF::loadView('backend.admin.invoices.download', ['invoice' => $invoice]);

            return $pdf->download('order_no_' . $id . '.pdf');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Order Not Found, try again later !');
                return redirect('/myaccount');
            }
            // return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end, try again later !');

            return redirect('/myaccount');
        }
    }

}
