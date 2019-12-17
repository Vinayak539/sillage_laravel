<?php
namespace App\Model;

use Log;
use \GuzzleHttp\Client;
use Validator;
use Illuminate\Contracts\Queue\ShouldQueue;

class SMS implements ShouldQueue
{
    public static $user     = "ranayas";
    public static $password = "ranayas@8451990711";
    public static $senderid = "ranyas";
    public static $route    = "06";

    public static function send($mobile, $text)
    {
        $val = Validator::make(['mobile' => $mobile, 'text' => $text], [
            'mobile' => 'required|digits:10',
            'text'   => 'required|string|max:250',
        ]);
        if ($val->fails()) {
            Log::info($val->errors());
            return;
        } else {
            try {
                $baseUrl = 'http://103.233.76.120/api/mt/SendSMS?user=' . self::$user . '&password=' . self::$password . '&senderid=' . self::$senderid . '&channel=Trans&DCS=0&flashsms=0&number=' . $mobile . '&text=' . $text . '&route=' .self::$route;

                $client  = new \GuzzleHttp\Client([
                    'http_errors' => false,
                ]);
                $res = $client->get($baseUrl);
                return;
            } catch (\Exception $ex) {
                Log::info('Error : ' . $ex->getMessage());
                return;
            }
        }
    }
}
