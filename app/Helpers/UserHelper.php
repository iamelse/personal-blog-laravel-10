<?php

if (!function_exists('getFirstName')) {
    function getFirstName($fullName): string
    {
        return explode(' ', trim($fullName))[0] ?? $fullName;
    }
}