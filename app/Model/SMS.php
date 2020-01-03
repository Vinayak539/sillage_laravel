<?php
namespace App\Model;

use Illuminate\Contracts\Queue\ShouldQueue;
use Log;
use Validator;
use \GuzzleHttp\Client;

class SMS implements ShouldQueue
{
    public static $user     = "hniperfumes";
    public static $password = "hni@2019";
    public static $senderid = "hnipfm";
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
                $baseUrl = 'http://103.233.76.120/api/mt/SendSMS?user=' . self::$user . '&password=' . self::$password . '&senderid=' . self::$senderid . '&channel=Trans&DCS=0&flashsms=0&number=' . $mobile . '&text=' . $text . '&route=' . self::$route;

                $client = new \GuzzleHttp\Client([
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
