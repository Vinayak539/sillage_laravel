<?php

namespace App\Model;

use GuzzleHttp\Client;

class Delivery
{
    public static $logistic_client_id = "KHUSHINATURALSSURFACE-B2C";
    public static $logistic_user_id   = "KHUSHINATURALSSURFACE";
    public static $logistic_api_token = "ca0d07eade1578f5e1a5ed4b69d5780354a568c1";
    public static $logistic_pickup    = "KHUSHINATURALS SURFACE";
    public static $logistic_base_url    = "https://staging-express.delhivery.com";

    public static $live_logistic_client_id = "KHUSHINATURALS SURFACE";
    public static $live_logistic_user_id   = "KHUSHINATURALSSURFACE";
    public static $live_logistic_api_token = "68b7e9fc555e3b81d4f451fe66871d9881c47e05";
    public static $live_logistic_pickup    = "KHUSHINATURALS SURFACE";
    public static $live_logistic_base_url    = "https://track.delhivery.com";
// 
    public static function verify($pincode)
    {
        try {
            $baseUrl = self::$live_logistic_base_url.'/c/api/pin-codes/json/?token=' . self::$live_logistic_api_token . '&filter_codes=' . $pincode;
            $client  = new \GuzzleHttp\Client([
                'http_errors' => false,
            ]);
            $res = $client->get($baseUrl);
            if ($res->getStatusCode() == 200) {
                $json = $res->getBody()->getContents();
                return $json;
            }
        } catch (\Exception $ex) {
            \Log::info('Error : ' . $ex->getMessage());
            return;
        }
    }

    public static function orderTrack($order)
    {
        try {

            $baseUrl = self::$live_logistic_base_url.'/api/packages/json/?ref_nos=' . $order . '&verbose=1&token=' . self::$live_logistic_api_token;

            $client = new \GuzzleHttp\Client([
                'http_errors' => false,
            ]);
            $res  = $client->get($baseUrl);
            $json = $res->getBody()->getContents();
            if ($res->getStatusCode() == 200) {
                return $json;
            }
        } catch (\Exception $ex) {
            \Log::info('Error : ' . $ex->getMessage());
            return;
        }
    }

    public static function orderCreation($order, $user)
    {
        $original_array = array(
            array(
                "city"         => $order->city,
                "name"         => $order->user_name,
                "pin"          => $order->pincode,
                "country"      => "India",
                "phone"        => $user->mobile,
                "add"          => $order->address,
                "payment_mode" => "Prepaid",
                "client"       => self::$live_logistic_client_id,
                "order"        => $order->id,
            ));

        $pickup = array(
            "city"    => "Thane",
            "name"    => self::$live_logistic_pickup,
            "pin"     => "421302",
            "country" => "India",
            "phone"   => "9619614785",
            "add"     => "Unit no.112, 1st Floor, Bldg no.A6,Harihar Complex, Dapode,Thane",
        );

        $data = json_encode(array("shipments" => $original_array, "pickup_location" => $pickup));
        // dd('format=json&data=' . $data);

        $curl = curl_init(self::$live_logistic_base_url.'/api/cmu/create.json');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'format=json&data=' . $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Accept: application/json",
            "Authorization: Token " . self::$live_logistic_api_token,
            "Content-Type: application/json",
        ));

        $response = curl_exec($curl);
        $err      = curl_error($curl);

        curl_close($curl);

        if ($err) {
            \Log::info('Error : ' . $err);
            return;
        } else {
            \Log::info($response);
            return;
        }
    }

    public static function codOrderCreation($order, $user)
    {
        $original_array = array(
            array(
                "city"                 => $order->city,
                "name"                 => $order->user_name,
                "pin"                  => $order->pincode,
                "country"              => "India",
                "phone"                => $user->mobile,
                "add"                  => $order->address,
                "payment_mode"         => "COD",
                "client"               => self::$live_logistic_client_id,
                "order"                => $order->id,
                'consignee_gst_amount' => $order->tax,
                'cod_amount'           => $order->total,
                'total_amount'         => $order->total,
            ));

        $pickup = array(
            "city"    => "Thane",
            "name"    => self::$live_logistic_pickup,
            "pin"     => "421302",
            "country" => "India",
            "phone"   => "9619614785",
            "add"     => "Unit no.112, 1st Floor, Bldg no.A6,Harihar Complex, Dapode,Thane",
        );

        $data = json_encode(array("shipments" => $original_array, "pickup_location" => $pickup));
        // dd('format=json&data=' . $data);

        $curl = curl_init(self::$live_logistic_base_url.'/api/cmu/create.json');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'format=json&data=' . $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Accept: application/json",
            "Authorization: Token " . self::$live_logistic_api_token,
            "Content-Type: application/json",
        ));

        $response = curl_exec($curl);
        $err      = curl_error($curl);

        curl_close($curl);

        if ($err) {
            \Log::info('Error : ' . $err);
            return;
        } else {
            \Log::info($response);
            return;
        }
    }

    public static function cancelOrder($order_id)
    {
        try {

            $details = array(
                'cancellation' => 'true',
                'waybill'      => trim($order_id),
            );

            $data = json_encode($details);

            $curl = curl_init(self::$live_logistic_base_url.'/api/p/edit');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_ENCODING, '');
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "Accept: application/json",
                "Authorization: Token " . self::$live_logistic_api_token,
                "Content-Type: application/json",
            ));

            $response = curl_exec($curl);
            $err      = curl_error($curl);

            curl_close($curl);

            if ($err) {
                \Log::info('Error : ' . $err);
                return;
            } else {
                \Log::info($response);
                return $response;
            }

        } catch (\Exception $ex) {
            \Log::info('Cancel Order Error : ' . $ex->getMessage());
            return;
        }

    }
}
