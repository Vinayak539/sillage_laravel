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
        $orders = TxnOrder::whereNotIN('status', ['nc', 'Delivered'])->get();
        foreach ($orders as $order) {
            $res    = Delivery::orderTrack($order->id);
            $result = json_decode($res, true);
            if (array_key_exists('Error', $result)) {
                $track_response = [];
                Log::info('Error');
            } else {
                $result         = json_decode($res, true);
                $track_response = $result['ShipmentData'][0]['Shipment']['Status']['Status'];
                $track_response = 'Delivered';
                $order->update([
                    'status' => $track_response,
                ]);

                $total_sales   = $order->user->total_sales + $order->total;
                $total_rewards = $order->user->total_rewards;
                \Log::info(['Status' => $track_response]);
                // if ($track_response == 'Delivered' && $order->user->elite == true) {
                //     $order->user->update([
                //         'total_sales'   => $total_sales,
                //         'total_rewards' => round($total_rewards + (($order->tbt * 10) / 100), 0),
                //     ]);

                //     $delivery_date = $result['ShipmentData'][0]['Shipment']['Status']['StatusDateTime'];

                //     $order->update([
                //         'delivery_date' => $delivery_date,
                //     ]);

                //     $promo_user = TxnUser::where('promocode', $order->promocode)->first();
                    
                //     if ($promo_user) {
                //         $promo_user->update([
                //             'total_rewards' => round($promo_user->total_rewards + (($order->tbt * 10) / 100), 0),
                //         ]);
                //     }

                //     if ($order->user->sales_end_date) {
                //         $userDate = date('Y-m-d h:m:s', strtotime('+90 days', strtotime(str_replace('/', '-', $order->user->sales_start_date))));
                //         $order->user->update([
                //             'sales_end_date' => $userDate,
                //         ]);
                //     } else {

                //         $userDate = date('Y-m-d h:m:s', strtotime('+90 days', strtotime(str_replace('/', '-', \Carbon\Carbon::parse(now())->format('Y-m-d h:i:s')))));
                //         $order->user->update([
                //             'sales_start_date' => \Carbon\Carbon::parse(now())->format('Y-m-d h:i:s'),
                //             'sales_end_date'   => $userDate,
                //         ]);
                //     }

                //     $shop = Shop::where('shop_code', $order->promocode)->where('status', true)->first();
                //     if ($shop) {

                //         $final_dis = $shop->total + ($order->tbt * 0.1);
                //         $shop->update([
                //             'total' => round($final_dis, 0),
                //         ]);
                //     }

                //     SMS::send($order->user->mobile, 'Hni Lifestyle - Your Order has been Delivered successfully, Your Order No : ' . $order->id . ' Login for more detail on ' . url('/'));

                //     $pdf = PDF::loadView('backend.admin.invoices.download', ['invoice' => $order]);
                //     Mail::send(['html' => 'backend.admin.invoices.show'], ['invoice' => $order], function ($message) use ($order, $pdf) {
                //         $message->from('order-confirmation@hnilifestyle.com', 'Hni Lifestyle');
                //         $message->to($order->user->email, $order->user->name);
                //         $message->subject('Invoice copy of Order No ' . $order->id . ' From HNI Lifestyle');
                //         $message->attachData($pdf->output(), 'order_no_' . $order->id . '.pdf');
                //     });
                // }

                if ($track_response == 'Delivered') {
                    // $order->user->update([
                    //     'total_sales'   => $total_sales,
                    //     'total_rewards' => round($total_rewards + (($order->tbt * 5) / 100), 0),
                    // ]);

                    $delivery_date = $result['ShipmentData'][0]['Shipment']['Status']['StatusDateTime'];

                    $order->update([
                        'delivery_date' => $delivery_date,
                    ]);

                    // $promo_user = TxnUser::where('promocode', $order->promocode)->first();
                    // if ($promo_user) {
                    //     $promo_user->update([
                    //         'total_rewards' => round($promo_user->total_rewards + (($order->tbt * 10) / 100), 0),
                    //     ]);
                    // }

                    // if ($order->user->sales_end_date) {
                    //     $userDate = date('Y-m-d h:m:s', strtotime('+90 days', strtotime(str_replace('/', '-', $order->user->sales_start_date))));
                    //     $order->user->update([
                    //         'sales_end_date' => $userDate,
                    //     ]);
                    // } else {
                    //     $userDate = date('Y-m-d h:m:s', strtotime('+90 days', strtotime(str_replace('/', '-', \Carbon\Carbon::parse(now())->format('Y-m-d h:i:s')))));
                    //     $order->user->update([
                    //         'sales_start_date' => \Carbon\Carbon::parse(now())->format('Y-m-d h:i:s'),
                    //         'sales_end_date'   => $userDate,
                    //     ]);
                    // }

                    $shop = Shop::where('shop_code', $order->promocode)->where('status', true)->first();

                    if ($shop) {

                        $final_dis = $shop->total + ($order->tbt * 0.1);
                        
                        $shop->update([
                            'total' => round($final_dis, 0),
                        ]);
                    }

                    SMS::send($order->user->mobile, 'Hni Lifestyle - Your Order has been Delivered successfully, Your Order No : ' . $order->id . ' Login for more detail on ' . url('/'));

                    $pdf = PDF::loadView('backend.admin.invoices.download', ['invoice' => $order]);
                    Mail::send(['html' => 'backend.admin.invoices.show'], ['invoice' => $order], function ($message) use ($order, $pdf) {
                        $message->from('order-confirmation@hnilifestyle.com', 'Hni Lifestyle');
                        $message->to($order->user->email, $order->user->name);
                        $message->subject('Invoice copy of Order No ' . $order->id . ' From HNI Lifestyle');
                        $message->attachData($pdf->output(), 'order_no_' . $order->id . '.pdf');
                    });
                }

            }
        }
    }
}
