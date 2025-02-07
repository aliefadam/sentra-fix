<?php


if (!function_exists("active_navbar")) {
    function active_navbar($url)
    {
        return request()->is($url) ? 'text-pink-600' : 'text-black';
    }
}
