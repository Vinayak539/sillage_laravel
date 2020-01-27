<?php

namespace App\Http\Controllers;

use App\Model\Address;
use App\Model\Delivery;
use App\Model\MapColorSize;
use App\Model\Paytm;
use App\Model\Shop;
use App\Model\SMS;
use App\Model\Transaction;
use App\Model\TxnMasterGst;
use App\Model\TxnOrder;
use App\Model\TxnOrderDetail;
use App\Model\TxnUser;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        if (Cart::getContent()->count() <= 0) {

            connectify('error', 'Add Item', 'Please Add few Product in your cart first !');

            return redirect(route('search'));
        }
        $addresses = [];
        if (auth('user')->check()) {

            $addresses = Address::where('user_id', auth('user')->user()->id)->get();
        }

        $promocodes = DB::table('txn_users')->select('*')->where('elite', true)->inRandomOrder()->limit(5)->get();
        return view('frontend.order.checkout', compact('promocodes', 'addresses'));
    }

    public function checkout(Request $request)
    {
        $total_rewards = auth('user')->user()->total_rewards;

        $validator = Validator::make($request->all(), [
            'payment_mode' => 'nullable',
            'pincode' => 'required|digits:6',
            'choose_address' => 'required|numeric|min:1|exists:addresses,id',
        ],
            [
                'payment_mode.required' => 'Please Select Any of the Payment Mode !',
                'pincode.required' => 'Please Enter Pincode',
                'pincode.digits' => 'Pincode should be of 6 digits',
                'choose_address.required' => 'Please Choose Any Address',
                'choose_address.numeric' => 'Invalid Address provided',
                'choose_address.min' => 'Invalid Address provided',
                'choose_address.exists' => 'Address does not exists',
            ]);

        if ($request->filled('reward_points')) {
            $validator = Validator::make($request->all(), [
                'reward_points' => 'required|numeric|max:' . $total_rewards . '|min:0',
            ]);
        }

        if ($validator->fails()) {
            connectify('error', 'Checkout Error', $validator->errors()->first());
            return redirect(route('checkout'))->withInput();
        }

        if (Cart::getContent()->count() > 4) {

            connectify('error', 'Quantity', 'Whoops, Only 4 Quantity is Allowed at a time !');

            return redirect(route('checkout'));
        }

        $res = Delivery::verify($request->pincode);

        $res1 = json_decode($res, true);

        if (count($res1['delivery_codes'])) {

            $cartTotalQuantity = Cart::getTotalQuantity();

            $total = 0;
            $user = auth('user')->user();
            $cod = false;
            $totalGst = 0;
            $promocode = null;
            $is_valid_promocode = false;
            $is_discount = false;

            if ($request->session()->has('promocode')) {
                // $a = $request->session()->get('promocode');
                $a = $request->session()->pull('promocode', 'default');
                if ($a['promocode']) {
                    $promo = TxnUser::select('promocode')->where('promocode', $a['promocode'])->first();
                    $promocode = $promo['promocode'];
                } elseif ($a['shop_code']) {
                    $promo = Shop::select('shop_code')->where('shop_code', $a['shop_code'])->where('status', true)->first();
                    $promocode = $promo['shop_code'];
                    $is_valid_promocode = true;
                    $is_discount = true;
                }
            }

            foreach (Cart::getContent() as $item) {

                $size = MapColorSize::select(['*'])->where('id', $item->attributes->map_id)->first();

                $total += $size->mrp * $item->quantity;

                $gst = TxnMasterGst::where('id', $size->product->gst_id)->first();

                $gst_value = 1 + ($gst->gst_value / 100);

                $before_gst_price = round($size->mrp / $gst_value);

                $totalGst += round($size->mrp - $before_gst_price);

            }

            if ($request->payment_mode === 'cod') {
                $cod = true;
            }

            $request['status'] = 'nc';

            $request['payment_mode'] = $cod ? 'cod' : 'paytm';

            $request['shipingcharge'] = $cod ? 60 : 60;

            $request['tbt'] = round($total - $totalGst, 2);

            $request['discount'] = $is_valid_promocode ? $total * 0.10 : 0;

            if ($total < 1000) {
                $total = $total + $request->shipingcharge;
            }

            $request['total'] = round($total - $request->discount, 2);

            $add = Address::where('id', $request->choose_address)->first();

            $order = TxnOrder::create([
                'total' => $request->total,
                'status' => $request->status,
                'user_id' => $user->id,
                'user_name' => $user->name,
                'promocode' => $promocode,
                'discount' => $request->discount,
                'address' => $add->address,
                'pincode' => $add->pincode,
                'city' => $add->city,
                'territory' => $add->territory,
                'landmark' => $add->landmark,
                'country' => $add->country,
                'type_of_address' => $add->type_of_address,
                'tbt' => $request->tbt,
                'tax' => $totalGst,
                'payment_mode' => $request->payment_mode,
                'payment_status' => "Pending",
                'is_discount' => $is_discount,
            ]);

            $user->update([
                'address' => $add->address,
                'city' => $add->city,
                'territory' => $add->territory,
                'landmark' => $add->landmark,
                'pincode' => $add->pincode,
                'country' => $add->country,
                'address_id' => $add->id,
                'mobile' => $add->mobile,
            ]);

            foreach (Cart::getContent() as $item) {

                TxnOrderDetail::create([
                    'title' => $item->name,
                    'map_id' => $item->attributes->map_id,
                    'mrp' => $item->price,
                    'quantity' => $item->quantity,
                    'product_id' => $item->attributes->product_id,
                    'order_id' => $order->id,
                    'size_id' => $item->attributes->size_id,
                    'color_id' => $item->attributes->color_id,
                    'offers' => $item->attributes->offers,
                ]);
            }

            if ($request->payment_mode == 'cod') {
                \Log::info(['Order' => $order]);
                Delivery::codOrderCreation($order, $user);

                $user->update(['total_rewards' => $total_rewards - $request->reward_points]);

                $order->update([
                    'reward_points' => $request->reward_points,
                    'status' => 'Booked',
                ]);

                SMS::send($order->user->mobile, 'Hni Life Style - Your Order has been placed successfully, Your Order No : ' . $order->id . ' Login for more detail on ' . url('/'));

                Mail::send(['html' => 'backend.mails.received'], ['order' => $order], function ($message) use ($order) {
                    $message->to($order->user->email)->subject('Your order has been placed successfully ! [order no : ' . $order->id . ']');
                    $message->from('order-confirmation@hnilifestyle.com', 'Hni Life Style');
                });

                Mail::send(['html' => 'backend.mails.admin'], ['order' => $order], function ($message) use ($order) {
                    $message->to('order-confirmation@hnilifestyle.com')->subject('You have a new order ! [order id : ' . $order->id . ']');
                    $message->from('order-confirmation@hnilifestyle.com', 'Hni Life Style');
                });

                Cart::clear();

                connectify('success', 'Order Placed', 'Your Order has been placed Successfully !');

                return redirect(route('user.showOrder'));

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
                $paramList["TXN_AMOUNT"] = $request->total;
                $paramList["WEBSITE"] = env('PAYTM_MERCHANT_WEBSITE');
                $paramList["CALLBACK_URL"] = route('paytm.callback');
                $paramList["CHECKSUMHASH"] = $paytm->getChecksumFromArray($paramList, env('PAYTM_MERCHANT_KEY'));

                $request->session()->put("reward_points", $request->reward_points);

                return view('frontend.order.pg-redirect')->with('paramList', $paramList);
            }

        }

        connectify('error', 'Delivery Not Available', 'Delivery Not Available at ' . $request->pincode);

        return redirect(route('checkout'));
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

                    $reward = $request->session()->get("reward_points");

                    $order->update([
                        'status' => 'Booked',
                        'payment_status' => 'Paid',
                        'reward_points' => $reward,
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

                    Delivery::orderCreation($order, $order->user);

                    SMS::send($order->user->mobile, 'Hni Store - Your Order has been placed successfully, Your Order No : ' . $order->id . ' Login for more detail on ' . url('/'));

                    Mail::send(['html' => 'backend.mails.received'], ['order' => $order], function ($message) use ($order) {
                        $message->to($order->user->email)->subject('Your order has been placed successfully ! [order no : ' . $order->id . ']');
                        $message->from('order-confirmation@hnilifestyle.com', 'Hni Store');
                    });

                    Mail::send(['html' => 'backend.mails.admin'], ['order' => $order], function ($message) use ($order) {
                        $message->to('order-confirmation@hnilifestyle.com')->subject('You have a new order ! [order id : ' . $order->id . ']');
                        $message->from('order-confirmation@hnilifestyle.com', 'Hni Store');
                    });

                    $order->user->update(['total_rewards' => $order->user->total_rewards - $request->session()->get("reward_points", 'default')]);

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
