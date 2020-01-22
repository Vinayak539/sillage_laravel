<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Model\Delivery;
use App\Model\SMS;
use App\Model\TxnOrder;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

            $order = TxnOrder::where('id', $id)->with('details', 'user', 'transaction')->firstOrFail();
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

                connectify('error', 'Error', 'Whoops, Order Not Found !');

                return redirect(route('admin.orders.all'));
            }
            Log::info(['Show Order' => $ex->getMessage()]);

            connectify('error', 'Error', 'Whoops, Something went wrong from our end !');

            return redirect(route('admin.orders.all'));
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

                connectify('error', 'Error', 'Whoops, Order Not Found !');

                return redirect(route('admin.orders.all'));
            }

            connectify('error', 'Error', 'Whoops, Something went wrong from our end !');

            return redirect(route('admin.orders.all'));
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

            SMS::send($order->user->mobile, 'HNI Lifestyle - Your Order ID : ' . $order->id . ', has been ' . $order->status . ',  Login for more detail on ' . route('user.login'));

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
                    $message->from('order-confirmation@hnilifestyle.com', 'HNI Lifestyle');
                    $message->to($order->user->email, $order->user->name);
                    $message->subject('Invoice copy of Order No ' . $order->id . ' From HNI Lifestyle');
                    $message->attachData($pdf->output(), 'invoice_no_' . $order->id . '.pdf');
                });

            }

            connectify('success', 'Order Updated', 'Status has been updated to ' . $order->status);

            return redirect(route('admin.orders.show', $id));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', "No Such Order Found !");

                return redirect(route('admin.orders.all'));
            }

            connectify('error', 'Error', "Whoops, Something went wrong from our end !");

            return redirect(route('admin.orders.all'));
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

            SMS::send($order->user->mobile, 'HNI Lifestyle - Your Order ID : ' . $order->id . ', for Return and Refund is ' . $order->return_status . ',  Login for more detail on ' . route('user.login'));

            connectify('success', 'Status Updated', 'Status has been updated for return & refund to ' . $order->return_status . ' successfully !');

            return redirect(route('admin.orders.show', $id));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', "No Such Order Found !");

                return redirect(route('admin.orders.all'));
            }

            connectify('error', 'Error', "Whoops, Something Went Wrong from our end !");

            return redirect(route('admin.orders.all'));
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

}
