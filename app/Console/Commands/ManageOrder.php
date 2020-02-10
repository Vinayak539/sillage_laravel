<?php

namespace App\Console\Commands;

use App\Model\TxnOrder;
use Illuminate\Console\Command;

class ManageOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove Uncompleted Order from Database';

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
        $orders = TxnOrder::where('status', 'nc')->with('details')->get();
        foreach ($orders as $order) {
            \DB::table('txn_orders')->where('id', $order->id)->delete();
        }
    }
}
