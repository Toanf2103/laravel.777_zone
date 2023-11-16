<?php


namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function convertDateFormat($dateTimeString)
    {
        return $dateTimeString->format('d/m/Y');
    }

    public static function formatTimeAgo($dateTimeString)
    {
        $carbonDate = Carbon::parse($dateTimeString);

        return $carbonDate->diffForHumans();
    }
}
