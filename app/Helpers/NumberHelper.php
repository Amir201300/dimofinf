<?php

namespace App\Helpers;

class NumberHelper
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

    public function generateCode(){
        return mt_rand(999,9999);
    }

    public static function dispose()
    {
        self::$instance = null;
    }
}
