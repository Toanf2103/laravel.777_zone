<?php


namespace App\Helpers;

class NumberHelper
{
    public static function format($number)
    {
        return number_format($number, 0, ',', '.');
    }

    
}