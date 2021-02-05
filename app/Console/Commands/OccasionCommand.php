<?php

namespace App\Console\Commands;

use App\Model\SMS;
use App\Model\TxnUser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OccasionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'occasion:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail & SMS to Customer for discount on their birthday';

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
        $users = TxnUser::where('date_of_birth', \Carbon\Carbon::parse(now())->format('Y-m-d'))->get();

        foreach ($users as $user) {

            Mail::send(['html' => 'backend.mails.occasion'], ['user' => $user], function ($message) use ($user) {
                $message->from('contact@sillageniche.com', 'SILLAGE');
                $message->to($user->email, $user->name);
                $message->subject('SILLAGE Pvt. Ltd - Shop Now and Get 20% off');
            });

            SMS::send($user->mobile, 'Sillage - Wish you Happy Birthday on your Occasion, Shop Now and Get 20% off, Visit our website to avail offer - ' . url('/'));

            Log::info('Birthday Occasion Mail Sent to ' . $user->name . ' on ' . \Carbon\Carbon::parse(now())->format('Y-m-d'));
        }
    }
}
