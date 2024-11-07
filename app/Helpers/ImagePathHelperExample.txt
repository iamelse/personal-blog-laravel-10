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

if (!function_exists('getHomeImageProfile')) {
    function getHomeImageProfile($home)
    {
        $disk = env('FILESYSTEM_DISK');
        $placeholderUrl = 'https://via.placeholder.com/150';

        // Check for the PUBLIC disk
        if ($disk === EnumFileSystemDisk::PUBLIC->value) {
            if ($home->image && Storage::disk('public')->exists($home->image)) {
                return asset('storage/' . $home->image);
            }
        } 
        // Check for the PUBLIC_UPLOADS disk
        elseif ($disk === EnumFileSystemDisk::PUBLIC_UPLOADS->value) {
            // Directly using the uploads path
            $filePath = $home->image;
            if ($home->image && file_exists(public_path($filePath))) {
                return asset($filePath);
            }
        }

        return $placeholderUrl;
    }
}

if (!function_exists('getImageCompanyLogo')) {
    function getImageCompanyLogo($experience)
    {
        $disk = env('FILESYSTEM_DISK');
        $placeholderUrl = 'https://via.placeholder.com/150';

        // Check for the PUBLIC disk
        if ($disk === EnumFileSystemDisk::PUBLIC->value) {
            if ($experience->company_logo && Storage::disk('public')->exists($experience->company_logo)) {
                return asset('storage/' . $experience->company_logo);
            }
        } 
        // Check for the PUBLIC_UPLOADS disk
        elseif ($disk === EnumFileSystemDisk::PUBLIC_UPLOADS->value) {
            // Directly using the uploads path
            $filePath = $experience->company_logo;
            if ($experience->company_logo && file_exists(public_path($filePath))) {
                return asset($filePath);
            }
        }

        return $placeholderUrl;
    }
}

if (!function_exists('getImageSchoolLogo')) {
    function getImageSchoolLogo($education)
    {
        $disk = env('FILESYSTEM_DISK');
        $placeholderUrl = 'https://via.placeholder.com/150';

        // Check for the PUBLIC disk
        if ($disk === EnumFileSystemDisk::PUBLIC->value) {
            if ($education->school_logo && Storage::disk('public')->exists($education->school_logo)) {
                return asset('storage/' . $education->school_logo);
            }
        } 
        // Check for the PUBLIC_UPLOADS disk
        elseif ($disk === EnumFileSystemDisk::PUBLIC_UPLOADS->value) {
            // Directly using the uploads path
            $filePath = $education->school_logo;
            if ($education->school_logo && file_exists(public_path($filePath))) {
                return asset($filePath);
            }
        }

        return $placeholderUrl;
    }
}

if (!function_exists('getPostCoverImage')) {
    function getPostCoverImage($post)
    {
        $disk = env('FILESYSTEM_DISK');
        $placeholderUrl = 'https://via.placeholder.com/150';

        // Check for the PUBLIC disk
        if ($disk === EnumFileSystemDisk::PUBLIC->value) {
            if ($post->cover && Storage::disk('public')->exists($post->cover)) {
                return asset('storage/' . $post->cover);
            }
        } 
        // Check for the PUBLIC_UPLOADS disk
        elseif ($disk === EnumFileSystemDisk::PUBLIC_UPLOADS->value) {
            // Directly using the uploads path
            $filePath = $post->cover;
            if ($post->cover && file_exists(public_path($filePath))) {
                return asset($filePath);
            }
        }

        return $placeholderUrl;
    }
}