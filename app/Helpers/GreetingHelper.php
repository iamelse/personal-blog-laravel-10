<?php

namespace App\Helpers;

class GreetingHelper
{
    public static function getGreeting(): string
    {
        $hour = (int) now()->format('H');

        return match (true) {
            $hour >= 5 && $hour < 12 => 'Good Morning',
            $hour >= 12 && $hour < 17 => 'Good Afternoon',
            $hour >= 17 && $hour < 21 => 'Good Evening',
            default => 'Good Night',
        };
    }
}