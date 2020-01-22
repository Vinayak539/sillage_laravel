<?php

namespace App\Console\Commands;

use App\Model\SMS;
use App\Model\TxnUser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RewardCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reward:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail & SMS Notification to user for expiring rewards';

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
        $users = TxnUser::where('total_sales', '<>', 1500)->get();

        foreach ($users as $user) {

            $userDate = date('Y-m-d', strtotime('-3 days', strtotime(str_replace('/', '-', $user->sales_end_date))));

            if ($userDate == \Carbon\Carbon::parse(now())->format('Y-m-d')) {

                $user['remaining_reward'] = $user->total_sales - 1500;

                Mail::send(['html' => 'backend.mails.expire'], ['user' => $user], function ($message) use ($user) {
                    $message->from('contact@hnilifestyle.com', 'HNI Lifestyle');
                    $message->to($user->email, $user->name);
                    $message->subject('HNI Lifestyle Pvt. Ltd - Hurry Up Your Reward Expiring Soon Shop Now to avoid losing Rewards');
                });

                SMS::send($user->mobile, 'Hni - Wish you Happy Birthday on your Occasion, Hurry Up Your Reward Expiring Soon Shop Now to avoid losing Rewards, Visit our website - ' . url('/'));

                Log::info('Reward Expiry Mail Sent to ' . $user->name . ' on ' . \Carbon\Carbon::parse(now())->format('Y-m-d'));
            }

        }
    }
}
