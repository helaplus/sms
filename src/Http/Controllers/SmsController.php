<?php

namespace Helaplus\Sms\Http\Controllers;

use Illuminate\Http\Request;

class SmsController extends Controller
{
    public static function sendSms($to, $message)
    {
        $gateway = strtolower(config('sms.gateway'));
        switch ($gateway) {
            case 'wasiliana':
                return WasilianaSmsController::sendSms($to,$message);
                break;
            case 'africastalking':
                return ATSmsController::sendSmsViaAT($to,$message); 
                break;
            default :
                return WasilianaSmsController::sendSms($to,$message);
                break;
        }
    }
}
