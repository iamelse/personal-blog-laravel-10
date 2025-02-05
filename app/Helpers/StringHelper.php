<?php

if (!function_exists('truncateTableText')) {
    function truncateTableText($text, $length = 20, $suffix = '...')
    {
        return strlen($text) > $length ? substr($text, 0, $length) . $suffix : $text;
    }
}