<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

if(! function_exists("humanize_date")) {

    /**
     * Return a formatted Carbon date.
     */
    function humanize_date(Carbon $date, string $format = 'd F Y'): string
    {
        return $date->format( $format);
    }

}


if(! function_exists("get_slug_uuid")) {

    /**
     * Return a formatted Carbon date.
     */
    function get_slug_uuid(): string
    {
       return "-".Str::uuid()->toString();
    }

}