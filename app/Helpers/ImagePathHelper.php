<?php

use App\Enums\EnumFileSystemDisk;
use Illuminate\Support\Facades\Storage;

if (!function_exists('getUserImageProfilePath')) {
    function getUserImageProfilePath($user)
    {
        $disk = env('FILESYSTEM_DISK');
        $placeholderUrl = 'https://via.placeholder.com/150';

        // Check for the PUBLIC disk
        if ($disk === EnumFileSystemDisk::PUBLIC->value) {
            if ($user->image_profile && Storage::disk('public')->exists($user->image_profile)) {
                return asset('storage/' . $user->image_profile);
            }
        } 
        // Check for the PUBLIC_UPLOADS disk
        elseif ($disk === EnumFileSystemDisk::PUBLIC_UPLOADS->value) {
            // Directly using the uploads path
            $filePath = $user->image_profile;
            if ($user->image_profile && file_exists(public_path($filePath))) {
                return asset($filePath);
            }
        }

        return $placeholderUrl;
    }
}