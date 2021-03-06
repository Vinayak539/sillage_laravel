<?php

namespace App\Console\Commands;

use App\Model\Delivery;
use App\Model\Shop;
use App\Model\TxnOrder;
use App\Model\TxnUser;
use App\Model\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Model\SMS;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;

class OrderStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Track Order Status from delhivery and update in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $orders = TxnOrder::whereNotIN('status', ['nc', 'Delivered', 'Cancelled'])->get();
        foreach ($orders as $order) {
            $res    = Delivery::orderTrack($order->id);
            $result = json_decode($res, true);
            if (array_key_exists('Error', $result)) {
                $track_response = [];
                Log::info('Error');
            } else {
                $result         = json_decode($res, true);
                $track_response = $result['ShipmentData'][0]['Shipment']['Status']['Status'];

//                 $track_response = 'Delivered';

                $order->update([
                    'status' => $track_response,
                ]);

                \Log::info(['Status' => $track_response]);

                if ($track_response == 'Delivered') {

                    $delivery_date = $result['ShipmentData'][0]['Shipment']['Status']['StatusDateTime'];

                    $order->update([
                        'delivery_date' => $delivery_date,
                        'payment_status' => 'Paid',
                    ]);

                    $shop = Shop::where('shop_code', $order->promocode)->first();

                    if ($shop) {

                        $final_dis = $shop->total + floor($order->tbt * 0.1);

                        $shop->update([
                            'total' => floor($final_dis),
                        ]);

                        $order->update([
                            'reward_points' => floor($order->tbt * 0.1),
                        ]);

                        SMS::send($shop->mobile, 'SILLAGE - Congratulation You have Earned Rs.' . floor($order->tbt * 0.1) . ' on Order ID : ' . $order->id . ' Your Total Earning is Rs.' . $final_dis . ' for more login on sillageniche.com');

                    }

                    SMS::send($order->user->mobile, 'SILLAGE - Your Order has been Delivered successfully, Your Order ID : ' . $order->id . ' Login for more detail on ' . url('/'));

                    $pdf = PDF::loadView('backend.admin.invoices.download', ['invoice' => $order]);
                    Mail::send(['html' => 'backend.admin.invoices.empty'], ['invoice' => $order], function ($message) use ($order, $pdf) {
                        $message->from('order-confirmation@sillage.com', 'SILLAGE');
                        $message->to($order->user->email, $order->user->name);
                        $message->subject('Invoice copy of Order No ' . $order->id . ' From SILLAGE');
                        $message->attachData($pdf->output(), 'order_no_' . $order->id . '.pdf');
                    });
                    
                    Mail::send(['html' => 'backend.admin.invoices.empty'], ['invoice' => $order], function ($message) use ($order, $pdf) {
                        $message->from('order-confirmation@sillage.com', 'SILLAGE');
                        $message->to('abhishekgupta5544@gmail.com', 'Abhishek');
                        $message->subject('Invoice copy of Order No ' . $order->id . ' From SILLAGE');
                        $message->attachData($pdf->output(), 'order_no_' . $order->id . '.pdf');
                    });
                }

            }
        }
    }
}
