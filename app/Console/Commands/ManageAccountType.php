<?php

namespace App\Console\Commands;

use App\Model\TxnUser;
use App\Model\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ManageAccountType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manageaccount:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'after 90 days customers converted to prime to non prime user';

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
        $users = User::where('elite', false)->get();
        foreach ($users as $user) {
            $result = $user->sales_end_date == \Carbon\Carbon::parse(now())->format('Y-m-d');

            if ($result) {
                $user->update([
                    'total_sales' => 0,
                ]);

                Log::info('Customer ' . $user->name . ' till on ' . $user->created_at . ' Not Purchased of Rs.1500 & Total Rewards Converted to 0 ');
            }
        }

        $elite_users = TxnUser::where('elite', true)->get();
        foreach ($elite_users as $user) {
            $result = $user->sales_end_date == \Carbon\Carbon::parse(now())->format('Y-m-d');

            if ($result) {
                $user->update([
                    'total_sales' => round($user->total_sales / 2, 0),
                    'elite'       => false,
                ]);

                Log::info('Customer ' . $user->name . ' till on ' . $user->created_at . ' Not Purchased of Rs.1500 & Total Rewards Converted to half of total rewards and transfer HNI Prime Customer to Non Prime Customer');
            }
        }
    }
}
