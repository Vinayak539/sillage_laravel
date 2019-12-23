<?php

namespace App\Http\Controllers;

use App\Model\Delivery;
use App\Model\MapColorSize;
use App\Model\Paytm;
use App\Model\Transaction;
use App\Model\TxnOrder;
use App\Model\TxnOrderDetail;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class Ordercontroller extends Controller
{
    public function index()
    {
        if (Cart::getContent()->count() <= 0) {

            connectify('error', 'Add Item', 'Please Add few Product in your cart first !');

            return redirect(route('search'));
        }
        return view('frontend.order.checkout');
    }

    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required|string|max:1000',
            'name' => 'required|string|max:191',
            'mobile' => 'required|digits:10',
            'city' => 'required|string|max:191',
            'territory' => 'required|string|max:191',
            'landmark' => 'nullable|string|max:191',
            'payment_mode' => 'required',
            'pincode' => 'required|digits:6',
        ],
            [
                'payment_mode.required' => 'Please Select Any of the Payment Mode !',
                'address.required' => 'Please Enter Address',
                'name.required' => 'Please Enter Name',
                'city.required' => 'Please Enter City',
                'territory.required' => 'Please Enter Territory/State',
                'pincode.required' => 'Please Enter Pincode',
                'pincode.digits' => 'Pincode should be of 6 digits',
                'mobile.required' => 'Please Enter Mobile Number',
                'mobile.digits' => 'Mobile Number should be of 10 digits',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Checkout Error', $validator->errors()->first());
            return redirect(route('checkout'))->withInput();
        }

        $total = 0;
        $is_discount = false;
        $user = auth('user')->user();
        $cod = false;

        foreach (Cart::getContent() as $item) {
            $size = MapColorSize::select(['*'])->where('id', $item->id)->first();
            $total += $size->mrp * $item->quantity;
        }

        if ($request->payment_mode === 'cod') {
            $cod = true;
        }

        $request['status'] = 'nc';
        $request['shipingcharge'] = $cod ? 0 : 0;
        $request['payment_mode'] = $cod ? 'cod' : 'paytm';
        $request['tax'] = round($total - ($total / 1.18), 2);
        $request['tbt'] = round($total - $request->tax, 2);

        $request['total'] = round($request['tbt'] - $request->discount, 2);

        $request['final_amount'] = round($request->total + ($request->total * 0.18));

        $order = TxnOrder::create([
            'total' => $request->final_amount,
            'status' => $request->status,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'discount' => $request->discount,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'city' => $request->city,
            'territory' => $request->territory,
            'landmark' => $request->landmark,
            'tbt' => $request->tbt,
            'tax' => $request->tax,
            'payment_mode' => $request->payment_mode,
            'payment_status' => "Pending",
        ]);

        $user->update([
            'address' => $request->address,
            'city' => $request->city,
            'territory' => $request->territory,
            'landmark' => $request->landmark,
            'pincode' => $request->pincode,
            'name' => $request->name,
            'mobile' => $request->mobile,
        ]);

        foreach (Cart::getContent() as $item) {
            TxnOrderDetail::create([
                'title' => $item->name,
                'map_id' => $item->id,
                'mrp' => $item->price,
                'quantity' => $item->quantity,
                'product_id' => $item->attributes->product_id,
                'order_id' => $order->id,
            ]);
        }

        if ($request->payment_mode == 'cod') {
            \Log::info(['Order' => $order]);
            Delivery::codOrderCreation($order, $user);
            $order->update([
                'status' => 'Booked',
            ]);
            // SMS::send($order->user->mobile, 'Hni Lifestyle - Your Order has been placed successfully, Your Order No : ' . $order->id . ' Login for more detail on https://hnilifestyle.com');
            Mail::send(['html' => 'backend.mails.received'], ['order' => $order], function ($message) use ($order) {
                $message->to($order->user->email)->subject('Your order has been placed successfully ! [order no : ' . $order->id . ']');
                $message->from('order-confirmation@hnilifestyle.com', 'HNI Lifestyle');
            });
            Mail::send(['html' => 'backend.mails.admin'], ['order' => $order], function ($message) use ($order) {
                $message->to('order-confirmation@hnilifestyle.com')->subject('You have a new order ! [order id : ' . $order->id . ']');
                $message->from('order-confirmation@hnilifestyle.com', 'HNI Lifestyle');
            });
            Cart::clear();

            connectify('success', 'Order Placed', 'Your Order has been placed Successfully !');

            return redirect('/myaccount');

        } elseif ($request->payment_mode == 'paytm') {
            $paytm = new Paytm();
            $paramList = [];
            $paramList["MID"] = env('PAYTM_MERCHANT_MID');
            $paramList["ORDER_ID"] = $order->id;
            $paramList["CUST_ID"] = 'CUST' . $user->id;
            $paramList["INDUSTRY_TYPE_ID"] = env('INDUSTRY_TYPE_ID');
            $paramList["CHANNEL_ID"] = 'WEB';
            $paramList["MOBILE_NO"] = $user->mobile;
            $paramList["EMAIL"] = $user->email;
            $paramList["TXN_AMOUNT"] = $request->final_amount;
            $paramList["WEBSITE"] = env('PAYTM_MERCHANT_WEBSITE');
            $paramList["CALLBACK_URL"] = route('paytm.callback');
            $paramList["CHECKSUMHASH"] = $paytm->getChecksumFromArray($paramList, env('PAYTM_MERCHANT_KEY'));
            return view('frontend.order.pg-redirect')->with('paramList', $paramList);
        }
    }

    public function handleCallbackFromPaytm(Request $request)
    {
        $paramList = $request->all();
        $isValidChecksum = "FALSE";
        $paytmChecksum = $request->CHECKSUMHASH;
        $paytm = new Paytm();
        $isValidChecksum = $paytm->verifychecksum_e($paramList, env('PAYTM_MERCHANT_KEY'), $paytmChecksum);
        if ($isValidChecksum == "TRUE") {
            if ($paramList["STATUS"] == "TXN_SUCCESS") {
                $txnres = $request->all();
                \Log::info($txnres);
                unset($txnres['MID']);
                unset($txnres['ORDERID']);
                unset($txnres['CURRENCY']);
                unset($txnres['CHECKSUMHASH']);

                $order = TxnOrder::where('id', $request->ORDERID)->with('details', 'user', 'transaction')->firstOrFail();

                if ($order->status == 'nc') {

                    $order->update([
                        'status' => 'Booked',
                        'payment_status' => 'Paid',
                    ]);

                    $transaction = Transaction::create([
                        'order_id' => $paramList['ORDERID'],
                        'MID' => $paramList['MID'],
                        'TXNID' => $paramList['TXNID'],
                        'TXNAMOUNT' => $paramList['TXNAMOUNT'],
                        'PAYMENTMODE' => $paramList['PAYMENTMODE'],
                        'CURRENCY' => $paramList['CURRENCY'],
                        'TXNDATE' => $paramList['TXNDATE'],
                        'STATUS' => $paramList['STATUS'],
                        'RESPCODE' => $paramList['RESPCODE'],
                        'RESPMSG' => $paramList['RESPMSG'],
                        'GATEWAYNAME' => $paramList['GATEWAYNAME'],
                        'BANKTXNID' => $paramList['BANKTXNID'],
                        'CHECKSUMHASH' => $paramList['CHECKSUMHASH'],
                    ]);
                    if (array_key_exists('BANKNAME', $paramList)) {
                        $transaction->update([
                            'BANKNAME' => $paramList['BANKNAME'],
                        ]);
                    }
                    \Log::info(['Order' => $order]);

                    Delivery::orderCreation($order, $order->user);

                    // SMS::send($order->user->mobile, 'Hni Lifestyle - Your Order has been placed successfully, Your Order No : ' . $order->id . ' Login for more detail on http://hnilifestyle.com/');

                    Mail::send(['html' => 'backend.mails.received'], ['order' => $order], function ($message) use ($order) {
                        $message->to($order->user->email)->subject('Your order has been placed successfully ! [order no : ' . $order->id . ']');
                        $message->from('order-confirmation@hnilifestyle.com', 'HNI Lifestyle');
                    });

                    Mail::send(['html' => 'backend.mails.admin'], ['order' => $order], function ($message) use ($order) {
                        $message->to('order-confirmation@hnilifestyle.com')->subject('You have a new order ! [order id : ' . $order->id . ']');
                        $message->from('order-confirmation@hnilifestyle.com', 'HNI Lifestyle');
                    });

                    Cart::clear();
                }
                return view('frontend.order.transaction-success')->with('order', $order)->with('TXNID', $txnres['TXNID']);
            } else {
                return view('frontend.order.transaction-failed')->with('data', $request->except(['MID', 'CHECKSUMHASH']));
            }
        } else {
            return view('frontend.order.transaction-failed')->with('data', $request->except(['MID', 'CHECKSUMHASH']));
        }
    }
}
