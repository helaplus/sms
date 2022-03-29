<?php

namespace Helaplus\Sms\Http\Controllers;

use Illuminate\Http\Request;

class ATSmsController extends Controller
{
    public static function sendSmsViaAT($to, $message)
    {

        $sms = urlencode($message);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.africastalking.com/version1/messaging",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "username=".config('sms.at_api_key')."&to=$tel&message=$sms&from=".config('sms.at_sender_name'),
            CURLOPT_HTTPHEADER => array(
                "apikey: ".env('AT_API_KEY'),
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = [
            'message' => $response,
        ];
        return JsonResponse::create($data,200);
    }
}








