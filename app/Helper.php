<?php


if (!function_exists("active_navbar")) {
    function active_navbar($url)
    {
        return request()->is($url) ? 'text-pink-600' : 'text-black';
    }
}

if (!function_exists("active_sidebar")) {
    function active_sidebar($url)
    {
        return request()->is($url) || request()->is($url . '/*') ? 'text-white bg-pink-600' : 'text-gray-700 hover:bg-gray-100';
    }
}
