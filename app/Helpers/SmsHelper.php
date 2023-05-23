<?php

namespace App\Helpers;

use Twilio\Rest\Client;

class SmsHelper
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function sendSmsUsingTwilio($phone,$msg){
        $sid    = "ACe66c3a7c4d460f06dcdf2b96b4520262";
        $token  = "ea1ed95c057c1e0c993adf461e54c584";
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create($phone, // to
                array(
                    "from" => "+12542684868",
                    "body" => $msg
                )
            );

        print($message->sid);
    }

    public static function dispose()
    {
        self::$instance = null;
    }
}
