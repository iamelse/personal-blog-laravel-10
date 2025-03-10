<?php

use App\Enums\EnumFileSystemDisk;
use Illuminate\Support\Facades\Storage;

if (!function_exists('getUserImageProfilePath')) {
    function getUserImageProfilePath($user)
    {
        $disk = env('FILESYSTEM_DISK');
        $placeholderUrl = 'https://dummyimage.com/300';
        $appUrl = rtrim(env('APP_URL'), '/'); // Ensure there's no trailing slash in APP_URL
        $publicHtmlPath = base_path('../public_html'); // Define the relative path to public_html

        // Check for the PUBLIC disk
        if ($disk === EnumFileSystemDisk::PUBLIC->value) {
            if ($user->image_profile && Storage::disk('public')->exists($user->image_profile)) {
                return asset('storage/' . $user->image_profile);  // Use the existing logic for PUBLIC
            }
        } 
        // Check for the PUBLIC_UPLOADS disk
        elseif ($disk === EnumFileSystemDisk::PUBLIC_UPLOADS->value) {
            // Directly using the uploads path with APP_URL
            $filePath = $user->image_profile;
            $fullPath = $publicHtmlPath . '/' . $filePath; // Combine with the actual public_html path
            if ($user->image_profile && file_exists($fullPath)) {
                return $appUrl . '/' . $filePath;  // Use APP_URL to generate the full URL for PUBLIC_UPLOADS
            }
        }

        return $placeholderUrl;
    }
}

if (!function_exists('getHomeImageProfile')) {
    function getHomeImageProfile($home)
    {
        $disk = env('FILESYSTEM_DISK');
        $placeholderUrl = 'https://dummyimage.com/300';
        $appUrl = rtrim(env('APP_URL'), '/'); // Ensure there's no trailing slash in APP_URL
        $publicHtmlPath = base_path('../public_html'); // Define the relative path to public_html

        // Check for the PUBLIC disk
        if ($disk === EnumFileSystemDisk::PUBLIC->value) {
            if ($home->image && Storage::disk('public')->exists($home->image)) {
                return asset('storage/' . $home->image);  // Use the existing logic for PUBLIC
            }
        } 
        // Check for the PUBLIC_UPLOADS disk
        elseif ($disk === EnumFileSystemDisk::PUBLIC_UPLOADS->value) {
            // Directly using the uploads path with APP_URL
            $filePath = $home->image;
            $fullPath = $publicHtmlPath . '/' . $filePath; // Combine with the actual public_html path
            if ($home->image && file_exists($fullPath)) {
                return $appUrl . '/' . $filePath;  // Use APP_URL to generate the full URL for PUBLIC_UPLOADS
            }
        }

        return $placeholderUrl;
    }
}

if (!function_exists('getImageCompanyLogo')) {
    function getImageCompanyLogo($experience)
    {
        $disk = env('FILESYSTEM_DISK');
        $placeholderUrl = 'https://dummyimage.com/300';
        $appUrl = rtrim(env('APP_URL'), '/'); // Ensure there's no trailing slash in APP_URL
        $publicHtmlPath = base_path('../public_html'); // Define the relative path to public_html

        // Check for the PUBLIC disk
        if ($disk === EnumFileSystemDisk::PUBLIC->value) {
            if ($experience->company_logo && Storage::disk('public')->exists($experience->company_logo)) {
                return asset('storage/' . $experience->company_logo);  // Use the existing logic for PUBLIC
            }
        } 
        // Check for the PUBLIC_UPLOADS disk
        elseif ($disk === EnumFileSystemDisk::PUBLIC_UPLOADS->value) {
            // Directly using the uploads path with APP_URL
            $filePath = $experience->company_logo;
            $fullPath = $publicHtmlPath . '/' . $filePath; // Combine with the actual public_html path
            if ($experience->company_logo && file_exists($fullPath)) {
                return $appUrl . '/' . $filePath;  // Use APP_URL to generate the full URL for PUBLIC_UPLOADS
            }
        }

        return $placeholderUrl;
    }
}

if (!function_exists('getImageSchoolLogo')) {
    function getImageSchoolLogo($education)
    {
        $disk = env('FILESYSTEM_DISK');
        $placeholderUrl = 'https://dummyimage.com/300';
        $appUrl = rtrim(env('APP_URL'), '/'); // Ensure there's no trailing slash in APP_URL
        $publicHtmlPath = base_path('../public_html'); // Define the relative path to public_html

        // Check for the PUBLIC disk
        if ($disk === EnumFileSystemDisk::PUBLIC->value) {
            if ($education->school_logo && Storage::disk('public')->exists($education->school_logo)) {
                return asset('storage/' . $education->school_logo);  // Use the existing logic for PUBLIC
            }
        } 
        // Check for the PUBLIC_UPLOADS disk
        elseif ($disk === EnumFileSystemDisk::PUBLIC_UPLOADS->value) {
            // Directly using the uploads path with APP_URL
            $filePath = $education->school_logo;
            $fullPath = $publicHtmlPath . '/' . $filePath; // Combine with the actual public_html path
            if ($education->school_logo && file_exists($fullPath)) {
                return $appUrl . '/' . $filePath;  // Use APP_URL to generate the full URL for PUBLIC_UPLOADS
            }
        }

        return $placeholderUrl;
    }
}

if (!function_exists('getPostCoverImage')) {
    function getPostCoverImage($post)
    {
        $disk = env('FILESYSTEM_DISK');
        $placeholderUrl = 'https://dummyimage.com/300';
        $appUrl = rtrim(env('APP_URL'), '/'); // Ensure there's no trailing slash in APP_URL
        $publicHtmlPath = base_path('../public_html'); // Define the relative path to public_html

        // Check for the PUBLIC disk
        if ($disk === EnumFileSystemDisk::PUBLIC->value) {
            if ($post->cover && Storage::disk('public')->exists($post->cover)) {
                return asset('storage/' . $post->cover);  // Use the existing logic for PUBLIC
            }
        } 
        // Check for the PUBLIC_UPLOADS disk
        elseif ($disk === EnumFileSystemDisk::PUBLIC_UPLOADS->value) {
            // Directly using the uploads path with APP_URL
            $filePath = $post->cover;
            $fullPath = $publicHtmlPath . '/' . $filePath; // Combine with the actual public_html path
            if ($post->cover && file_exists($fullPath)) {
                return $appUrl . '/' . $filePath;  // Use APP_URL to generate the full URL for PUBLIC_UPLOADS
            }
        }

        return $placeholderUrl;
    }
}