<?php

namespace Helaplus\Sms\Http\Controllers;

use Illuminate\Http\Request;

class WasilianaSmsController extends Controller
{
    public static function sendSms($to,$message){
        $data = array();
        $data['recipients'] = array($to);
        $data['from'] = config('sms.wasiliana_sender_name');
        $data['message'] = $message;
        $url = 'https://api.wasiliana.com/api/v1/developer/sms/bulk/send/sms/request';
        $apiKey = "apiKey: ".config('sms.wasiliana_api_key');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                $apiKey)
        );
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $data = curl_exec($ch);
        if ($errno = curl_errno($ch)) {
            $error_message = curl_strerror($errno);
            echo "cURL error ({$errno}):\n {$error_message}";
        }
        curl_close($ch);
        $response = json_decode($data);
        return $response;
    }
}
