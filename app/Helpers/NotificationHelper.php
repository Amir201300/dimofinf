<?php

namespace App\Helpers;
define('API_ACCESS_KEY', 'AAAAInzDyoU:APA91bEx9z1uaSNzGJhANWqKcjO_HHd3hqQ3gsizZJPLqp_y9FeN0YuxBIg-yUR7lTypYop_Up8aXLtW2SAsBVdfl0ftDlUpIHshNlzru5b0sxcUrK5dSyjKwwaJbZOV_T5xS0eW5zPh');

class NotificationHelper
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

    public function sendNotification($firebase_token,$title,$desc){
        $url = 'https://fcm.googleapis.com/fcm/send';
        $msg = array(
            'body'  => $desc,
            'title'     => $title,
            'vibrate'   => 1,
            'sound'     => 1,
            'click_action'=>"",
            'status'=>"1",
        );
        $fields = array(
            'to' => $firebase_token,
            'data' => $msg,
            'notification' => $msg,
        );
        $headers = array(
            'Authorization: key='.API_ACCESS_KEY,
            'Content-type: Application/json'
        );
        try{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);
        } catch(Exeption $e){
            return $e ;
        }
    }

    public static function dispose()
    {
        self::$instance = null;
    }
}
