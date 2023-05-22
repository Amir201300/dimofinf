<?php
namespace App\Helpers;

class DateHelper
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

    public function customDateFormat($date){
        return date('m/d/Y', strtotime($date));
    }

    public function customTimeFormat($date){
        return date('h:i a', strtotime($date));
    }

    public static function dispose()
    {
        self::$instance = null;
    }
}
