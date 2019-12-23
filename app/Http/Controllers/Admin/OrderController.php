<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Model\Delivery;
use App\Model\SMS;
use App\Model\TxnOrder;
use App\Model\TxnOrderDetail;
use App\Model\TxnShipping;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $orders = TxnOrder::whereNotIn('status', ['nc'])->orderBy('id', 'DESC');

        if ($request->filled('order_id')) {
            $orders = $orders->where('id', $request->order_id);
        }

        if ($request->filled('city')) {
            $orders = $orders->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('pincode')) {
            $orders = $orders->where('pincode', 'like', '%' . $request->pincode . '%');
        }

        if ($request->filled('order_date')) {
            $orders = $orders->where('created_at', 'like', '%' . date('Y-m-d', strtotime($request->order_date)) . '%');
        }

        $orders = $orders->paginate(50);
        return view('backend.admin.orders.index', compact('orders'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        try {

            $order     = TxnOrder::where('id', $id)->with('details', 'user', 'transaction', 'shipping')->firstOrFail();
            $res = Delivery::orderTrack($order->id);
            $result = json_decode($res, true);
            if (array_key_exists('Error', $result)) {
                $track_response = [];
            } else {
                $track_response = $result['ShipmentData'][0]['Shipment'];
            }

            return view('backend.admin.orders.show', compact('order', 'track_response'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.orders.all'))->with('messageDanger', 'Whoops, Order Not Found !');
            }
            return redirect(route('admin.orders.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    public function generateLabel(Request $request, $id)
    {
        try {

            TxnOrder::where('id', $id)->firstOrFail();

            $label = $request->all();

            $pdf = PDF::loadView('backend.admin.orders.generate-label', ['label' => $label]);

            return $pdf->download('order_no_' . $id . '.pdf');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.orders.all'))->with('messageDanger', 'Whoops, Order Not Found !');
            }
            return redirect(route('admin.orders.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
            'status' => 'required|string',
        ],
            [
                'status' => 'Please Select Status',
            ]);
        try {

            $order = TxnOrder::where('id', $id)->with('user', 'details')->firstOrFail();

            $order->update([

                'status' => $request->status,
            ]);

            // SMS::send($order->user->mobile, 'The Hatke Store - Your Order ID : ' . $order->id . ', has been ' . $order->status . ',  Login for more detail on http://thehatkestore.com/myaccount');

            if ($request->filled('status') && $request->status == 'delivered') {

                $total = floor($order->total / 50);

                $total_rewards = $order->user->total_rewards + $total;

                $order->update([
                    'reward_points' => $total,
                    'delivery_date' => \Carbon\Carbon::now(),
                ]);

                $order->user->update([
                    'total_rewards' => $total_rewards,
                ]);

                if (count($order->details)) {
                    foreach ($order->details as $detail) {
                        $detail->product->update([
                            'stock' => $detail->product->stock - $detail->quantity,
                        ]);
                    }
                }

                $pdf = PDF::loadView('backend.admin.invoices.download', ['invoice' => $order]);

                Mail::send(['html' => 'backend.admin.invoices.empty'], ['invoice' => $order], function ($message) use ($order, $pdf) {
                    $message->from('order-confirmation@thehatkestore.com', 'The Hatke Store');
                    $message->to($order->user->email, $order->user->name);
                    $message->subject('Invoice copy of Order No ' . $order->id . ' From The Hatke Store');
                    $message->attachData($pdf->output(), 'invoice_no_' . $order->id . '.pdf');
                });

            }

            return redirect(route('admin.orders.show', $id))->with('messageSuccess', 'Status has been updated to ' . $order->status);

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.orders.all'))->with('messageDanger', "No Such Order Found !!");
            }
            return redirect(route('admin.orders.all'))->with('messageDanger', "Error, " . $ex->getMessage());
        }
    }

    public function returnUpdate(Request $request, $id)
    {

        $request->validate([
            'return_status' => 'required|string',
        ],
            [
                'return_status' => 'Please Select Status',
            ]);
        try {

            $order = TxnOrder::where('id', $id)->with('user')->firstOrFail();

            $order->update([

                'return_status' => $request->return_status,
            ]);

            SMS::send($order->user->mobile, 'The Hatke Store - Your Order ID : ' . $order->id . ', for Return and Refund is ' . $order->return_status . ',  Login for more detail on http://thehatkestore.com/myaccount');

            return redirect(route('admin.orders.show', $id))->with('messageSuccess', 'Status has been updated for return & refund to ' . $order->return_status . ' successfully !');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.orders.all'))->with('messageDanger', "No Such Order Found !!");
            }
            return redirect(route('admin.orders.all'))->with('messageDanger', "Error, " . $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function export()
    {
        return Excel::download(new OrderExport, 'orders.xlsx');
    }

    public function assignShipment(Request $request, $id)
    {

        $request->validate([
            'awf_number'    => 'required|string|max:15',
            'status'        => 'required|string',
            'shipping_id'   => 'required|numeric|exists:txn_shippings,id',
            'delivery_date' => 'nullable|date_format:Y-m-d',
        ],
            [
                'awf_number.required'       => 'Please Enter Awf Number',
                'awf_number.max'            => 'Please Enter Awf Number less than 15 character',
                'status.required'           => 'Please Choose Order Status',
                'shipping_id.required'      => 'Please Select Shipping Company',
                'shipping_id.numeric'       => 'invalid Shipping Data Provided',
                'shipping_id.exists'        => 'Shipping Partner does not exists',
                'delivery_date.date_format' => 'Please Enter delivery data in dd-mm-yyyy format',
            ]);

        try {

            $order = TxnOrder::where('id', $id)->with('shipping')->firstOrFail();

            $order->update([
                'awf_number'    => $request->awf_number,
                'status'        => $request->status,
                'shipping_id'   => $request->shipping_id,
                'delivery_date' => $request->delivery_date,
            ]);

            $order = TxnOrder::where('id', $id)->with('shipping')->first();

            if ($order->status == 'shipped') {
                SMS::send($order->user->mobile, 'The Hatke Store - Your Order has been shipped by : ' . $order->shipping->name . ' you can track from ' . $order->shipping->website_url . ' With Tracking No ' . $order->awf_number . ' Expected Delivery date ' . date('d-M-Y', strtotime($order->delivery_date)));
            }

            return redirect(route('admin.orders.show', $id))->with('messageSuccess', 'Order Assign to ' . $order->shipping->name . ' has been Updated Successfully !');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.orders.all'))->with('messageDanger', 'Whoops, Order Not Found !');
            }
            return redirect(route('admin.orders.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    public function updateCharges(Request $request)
    {

        $request->validate([
            'packing_price'    => 'required|numeric',
            'other_charges'    => 'required|numeric',
            'shipping_charges' => 'required|numeric',
        ],
            [
                'packing_price.numeric'    => 'invalid Packing Data Provided',
                'other_charges.numeric'    => 'invalid Other Charges Data Provided',
                'shipping_charges.numeric' => 'invalid Shipping Charges Data Provided',
            ]);

        try {

            $orderDetail = TxnOrderDetail::where('id', $request->order_details_id)->firstOrFail();

            $total = $orderDetail->total - ($orderDetail->packing_price + $orderDetail->other_charges + $orderDetail->shipping_charges);

            $pnl = ($orderDetail->product->starting_price * $orderDetail->quantity) < $total ? 'Profit' : 'Loss';

            $orderDetail->update([
                'packing_price'    => $request->packing_price,
                'other_charges'    => $request->other_charges,
                'shipping_charges' => $request->shipping_charges,
                'pnl'              => $pnl,
            ]);

            return redirect(route('admin.orders.show', $orderDetail->order_id))->with('messageSuccess', 'Order has been Updated Successfully !');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.orders.all'))->with('messageDanger', 'Whoops, Order Not Found !');
            }
            return redirect(route('admin.orders.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

}
