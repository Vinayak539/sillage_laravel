<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Address;
use App\Model\Delivery;
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
use Illuminate\Support\Facades\Validator;

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
                $q->where('status', '<>', 'nc')->orderBy('id', 'desc')->get();
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
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:191',
            'mobile'    => 'required|digits_between:10,12',
            'city'      => 'required|string|max:191',
            'territory' => 'required|string|max:191',
            'address'   => 'required|string',
            'pincode'   => 'required|digits:6',
        ],
            [
                'name.required'         => 'Please Enter Name',
                'mobile.required'       => 'Please Enter Mobile Number',
                'mobile.digits_between' => 'Mobile Number should be between 10 to 12 digits',
                'city.required'         => 'Please Enter City',
                'territory.required'    => 'Please Enter State',
                'address.required'      => 'Please Enter Address',
                'pincode.required'      => 'Please Enter Pincode',
                'pincode.digits'        => 'Pincode should be of 6 digits',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Error', $validator->errors()->first());
            return back()->withInput();
        }

        try {
            $user = TxnUser::where('id', auth('user')->user()->id)->firstOrFail();

            $user->update([
                'name'      => $request->name,
                'mobile'    => $request->mobile,
                'city'      => $request->city,
                'address'   => $request->address,
                'territory' => $request->territory,
                'pincode'   => $request->pincode,
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
        $validator = Validator::make($request->all(), [
            'password'     => 'required_with:con_password|max:191',
            'con_password' => 'required_with:password|max:191',
        ],
            [
                'password.required_with'     => 'Please Enter New Password to change password',
                'con_password.required_with' => 'Please Enter Old Password to change password',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Error', $validator->errors()->first());
            return back()->withInput();
        }

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
        $validator = Validator::make($request->all(), [
            'reason'    => 'required|string|max:191',
            'image_url' => 'nullable|image|max:1024|mimes:jpeg,png',
        ],
            [
                'reason.required' => 'Please Select Reason',
                'image_url.image' => 'Please Select Proper Image',
                'image_url.max'   => 'Please Select Image of Maximum size 1MB',
                'image_url.mimes' => 'Please Select Image of type JPEG & PNG',
            ]);

        if ($request->reason == 'other') {
            $validator = Validator::make($request->all(), [
                'other_reason' => 'required|string|max:500',
            ],
                [
                    'other_reason.required' => 'Please Write Reason',
                    'other_reason.max'      => 'Please Write Reason in 500 characters',
                ]);
        }

        if ($validator->fails()) {
            connectify('error', 'Error', $validator->errors()->first());
            return back()->withInput();
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
                'image_url'     => $request->img,
                'other_reason'  => $request->other_reason,
            ]);

            $ticket = Returnticket::create([
                'email'       => $order->user->email,
                'subject'     => 'Return & Refund',
                'open_by'     => auth('user')->user()->name,
                'status'      => true,
                'description' => 'Applied for Return and Refund against Order ID : ' . $order->id,
            ]);

            SMS::send($order->user->mobile, 'HNI Lifestyle - You have applied for Return and Refund against Order ID : ' . $order->id . ', Stay tuned for approval on ' . route('user.login'));

            Mail::send(['html' => 'backend.mails.ticket'], ['ticket' => $ticket], function ($message) use ($ticket) {
                $message->from('support@hnilifestyle.com', 'HNI Lifestyle');
                $message->to($ticket->email, 'HNI Lifestyle');
                $message->bcc('support@hnilifestyle.com', 'HNI Lifestyle');
                $message->subject('HNI Lifestyle RE:' . $ticket->subject . ' Ticket ID : ' . $ticket->id);
            });

            connectify('success', 'Return Order', 'Order Return applied successfully, stay tuned for approval !');

            return redirect(route('user.dashboard'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Order Not Found, try again later !');
                return redirect(route('user.dashboard'));
            }
            // return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end, try again later !');

            return redirect(route('user.dashboard'));
        }
    }

    public function cancelOrder(Request $request)
    {
        try {

            $order = TxnOrder::where('id', $request->order_id)->with('user')->firstOrFail();

            $res = json_decode(Delivery::cancelOrder($order->id));

            if ($res->status == true) {

                $order->update([
                    'status' => 'Cancelled',
                ]);

                SMS::send($order->user->mobile, 'HNI Lifestyle - Your Order ID : ' . $order->id . ', has been Cancelled successfully,  Login for more detail on ' . url('/'));

                Mail::send(['html' => 'backend.mails.order-cancel'], ['order' => $order], function ($message) use ($order) {
                    $message->to('support@hnilifestyle.com')->subject('Order has been Cancelled ! [order id : ' . $order->id . ']');
                    $message->from('support@hnilifestyle.com', 'HNI Lifestyle');
                });

                connectify('success', 'Order Cancel', 'Order Cancelled Successfully !');

                return redirect(route('user.order', $request->order_id));
            }

            connectify('error', 'Order Cancel', 'Whoops, Something Went wrong, try again later !');

            return back();

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Order Not Found, try again later !');
                return redirect(route('user.dashboard'));
            }
            return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end, try again later !');

            return redirect(route('user.dashboard'));
        }
    }

    public function orderHelp(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
        ],
            [
                'description.required' => 'Please Enter your query',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Error', $validator->errors()->first());
            return back()->withInput();
        }
        try {

            $order = TxnOrder::where('id', $id)->with('user')->firstOrFail();

            $ticket = Ticket::create([
                'email'       => $order->user->email,
                'subject'     => 'Order By : ' . $order->id,
                'description' => $request->description,
                'open_by'     => auth('user')->user()->name . ' - Customer',
                'status'      => true,
            ]);

            Mail::send(['html' => 'backend.mails.ticket'], ['ticket' => $ticket], function ($message) use ($ticket) {
                $message->from('support@hnilifestyle.com', 'HNI Lifestyle');
                $message->to($ticket->email, 'HNI Lifestyle');
                $message->bcc('support@hnilifestyle.com', 'HNI Lifestyle');
                $message->subject('HNI Lifestyle' . $ticket->subject . ' Ticket ID : ' . $ticket->id);
            });

            connectify('success', 'Need Help', 'Your query has been sent successfully, our expert will get in touch with you soon, stay tuned !');

            return redirect(route('user.order', $id));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Order Not Found, try again later !');
                return redirect(route('user.dashboard'));
            }
            // return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end, try again later !');

            return redirect(route('user.dashboard'));
        }
    }

    public function review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|exists:txn_products,id',
            'rating'     => 'required|integer|max:5|min:1',
            'comment'    => 'required|string',
        ],
            [
                'product_id.required' => 'Please Select Product',
                'product_id.integer'  => 'Invalid data provided',
                'product_id.exists'   => 'Product Not Found !',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Error', $validator->errors()->first());
            return back()->withInput();
        }

        try {

            $user = TxnUser::where('id', auth('user')->user()->id)->firstOrFail();

            TxnReview::updateOrCreate([
                'user_id'    => $user->id,
                'product_id' => $request->product_id,
            ],
                [
                    'user_id'    => $user->id,
                    'name'       => $user->name,
                    'email'      => $user->email,
                    'product_id' => $request->product_id,
                    'rating'     => $request->rating,
                    'comment'    => $request->comment,
                    'status'     => false,
                ]
            );

            connectify('success', 'Review Added', 'Thank you for Reviwing our product !');

            return back();

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Order Not Found, try again later !');
                return redirect(route('user.dashboard'));
            }
            // return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end, try again later !');

            return redirect(route('user.dashboard'));
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
                return redirect(route('user.dashboard'));
            }
            // return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end, try again later !');

            return redirect(route('user.dashboard'));
        }
    }

    public function getAddresses()
    {
        try {

            $user = TxnUser::where('id', auth('user')->user()->id)->with('addresses')->firstOrFail();
            return view('frontend.user.addresses', compact('user'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, User Not Found, try again later !');
                return redirect(route('user.dashboard'));
            }
            return $ex->getMessage();
            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end, try again later !');
            return redirect(route('user.dashboard'));
        }
    }

    public function editAddress($id)
    {
        try {

            $add = Address::where('id', $id)->firstOrFail();
            return view('frontend.user.edit-address', compact('add'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, User Not Found, try again later !');
                return redirect(route('user.dashboard'));
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end, try again later !');
            return redirect(route('user.dashboard'));
        }
    }

    public function fEditAddress(Request $request)
    {
        try {

            $add = Address::where('id', $request->address_id)->firstOrFail();

            if (!empty($add)) {

                return response()->json(['data' => $add], 200);
            }

            return response()->json(['error' => []], 200);

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return response()->json(['error' => []], 200);

            }
            \Log::error(['feditAddress' => $ex->getMessage()]);
            return response()->json(['error' => []], 200);

        }
    }

    public function UpdateAddress(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'address'         => 'required|string|max:1000',
            'city'            => 'required|string|max:191',
            'territory'       => 'required|string|max:191',
            'landmark'        => 'nullable|string|max:191',
            'pincode'         => 'required|digits:6',
            'type_of_address' => 'required|numeric|min:0|max:1',
        ],
            [
                'payment_mode.required'    => 'Please Select Any of the Payment Mode !',
                'address.required'         => 'Please Enter Address',
                'city.required'            => 'Please Enter City',
                'territory.required'       => 'Please Enter Territory/State',
                'pincode.required'         => 'Please Enter Pincode',
                'pincode.digits'           => 'Pincode should be of 6 digits',
                'type_of_address.required' => 'Please Select Type of Address',
                'type_of_address.numeric'  => 'Invalid data provided',
                'type_of_address.min'      => 'Invalid data provided',
                'type_of_address.max'      => 'Invalid data provided',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Error', $validator->errors()->first());
            return back()->withInput();
        }

        try {

            $add = Address::where('id', $id)->firstOrFail();

            $add->update([
                'city'            => $request->city,
                'territory'       => $request->territory,
                'address'         => $request->address,
                'landmark'        => $request->landmark,
                'pincode'         => $request->pincode,
                'type_of_address' => $request->type_of_address,
                'name'            => $request->name,
            ]);

            connectify('success', 'Address Updated', 'Address has been updated successfully !');
            return back();

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, User Not Found, try again later !');
                return back();
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end, try again later !');
            return back();
        }
    }

    public function deleteAddress(Request $request)
    {
        try {

            $address = Address::where('id', $request->address_id)->with('user')->firstOrFail();

            $address->user->update([
                'address_id' => null,
            ]);

            $address->delete();

            connectify('success', 'Address Deleted', 'Address has been removed successfully from your list !');

            return back();

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, Address Not Found, try again later !');
                return back();
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end, try again later !');
            return back();
        }
    }

    public function storeAddress(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'address'         => 'required|string|max:1000',
            'city'            => 'required|string|max:191',
            'territory'       => 'required|string|max:191',
            'landmark'        => 'nullable|string|max:191',
            'pincode'         => 'required|digits:6',
            'mobile'          => 'required|digits:10',
            'type_of_address' => 'required|numeric|min:0|max:1',
        ],
            [
                'payment_mode.required'    => 'Please Select Any of the Payment Mode !',
                'address.required'         => 'Please Enter Address',
                'city.required'            => 'Please Enter City',
                'territory.required'       => 'Please Enter Territory/State',
                'pincode.required'         => 'Please Enter Pincode',
                'pincode.digits'           => 'Pincode should be of 6 digits',
                'mobile.required'          => 'Please Enter Mobile Number',
                'mobile.digits'            => 'Mobile number should be of 10 digits',
                'type_of_address.required' => 'Please Select Type of Address',
                'type_of_address.numeric'  => 'Invalid data provided',
                'type_of_address.min'      => 'Invalid data provided',
                'type_of_address.max'      => 'Invalid data provided',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Error', $validator->errors()->first());
            return back()->withInput();
        }

        try {

            $user = TxnUser::where('id', auth('user')->user()->id)->firstOrFail();

            $request['country'] = $request->country ? $request->country : 'India';
            $request['name']    = $request->name ? $request->name : $user->name;

            Address::create([
                'city'            => $request->city,
                'territory'       => $request->territory,
                'address'         => $request->address,
                'landmark'        => $request->landmark,
                'country'         => $request->country,
                'pincode'         => $request->pincode,
                'type_of_address' => $request->type_of_address,
                'user_id'         => $user->id,
                'name'            => $request->name,
                'mobile'          => $request->mobile,
            ]);

            connectify('success', 'Address Saved', 'New Address has been added to your list !');
            return back();

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, User Not Found, try again later !');
                return back();
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end, try again later !');
            return back();
        }
    }

    public function fUpdateAddress(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'address'         => 'required|string|max:1000',
            'city'            => 'required|string|max:191',
            'territory'       => 'required|string|max:191',
            'landmark'        => 'nullable|string|max:191',
            'pincode'         => 'required|digits:6',
            'mobile'          => 'required|digits:10',
            'type_of_address' => 'required|numeric|min:0|max:1',
        ],
            [
                'payment_mode.required'    => 'Please Select Any of the Payment Mode !',
                'address.required'         => 'Please Enter Address',
                'city.required'            => 'Please Enter City',
                'territory.required'       => 'Please Enter Territory/State',
                'pincode.required'         => 'Please Enter Pincode',
                'pincode.digits'           => 'Pincode should be of 6 digits',
                'type_of_address.required' => 'Please Select Type of Address',
                'type_of_address.numeric'  => 'Invalid data provided',
                'type_of_address.min'      => 'Invalid data provided',
                'type_of_address.max'      => 'Invalid data provided',
                'mobile.required'          => 'Please Enter Mobile Number',
                'mobile.digits'            => 'Mobile number should be of 10 digits',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Error', $validator->errors()->first());
            return back()->withInput();
        }

        try {

            $add = Address::where('id', $request->address_id)->firstOrFail();

            $add->update([
                'city'            => $request->city,
                'territory'       => $request->territory,
                'address'         => $request->address,
                'landmark'        => $request->landmark,
                'pincode'         => $request->pincode,
                'type_of_address' => $request->type_of_address,
                'name'            => $request->name,
                'mobile'          => $request->mobile,
            ]);

            connectify('success', 'Address Updated', 'Address has been updated successfully !');
            return back();

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                connectify('error', 'Error', 'Whoops, User Not Found, try again later !');
                return back();
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our end, try again later !');
            return back();
        }
    }

}
