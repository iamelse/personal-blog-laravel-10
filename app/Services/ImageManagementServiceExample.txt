<?php

namespace App\Services;

use App\Enums\EnumFileSystemDisk;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageManagementService
{
    public function uploadImage(UploadedFile $file, array $options = [])
    {
        $currentImagePath = $options['currentImagePath'] ?? null;
        $disk = $options['disk'] ?? EnumFileSystemDisk::PUBLIC->value;
        $folder = $options['folder'] ?? null;

        if ($disk === EnumFileSystemDisk::PUBLIC->value) {
            if ($currentImagePath && Storage::disk('public')->exists($currentImagePath)) {
                Storage::disk('public')->delete($currentImagePath);
            }

            $imagePath = $file->store($folder, 'public');
            return $imagePath;

        } elseif ($disk === EnumFileSystemDisk::PUBLIC_UPLOADS->value) {
            $directory = public_path($folder);

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            $fileName = time() . '.' . $file->extension();

            if ($currentImagePath && File::exists(public_path($currentImagePath))) {
                File::delete(public_path($currentImagePath));
            }

            $file->move($directory, $fileName);
            return $folder . '/' . $fileName;
        }

        return null;
    }

    public function destroyImage($currentImagePath, $disk = EnumFileSystemDisk::PUBLIC->value)
    {
        if ($disk === EnumFileSystemDisk::PUBLIC->value) {
            if ($currentImagePath && Storage::disk('public')->exists($currentImagePath)) {
                Storage::disk('public')->delete($currentImagePath);
                return true;
            }
        } elseif ($disk === EnumFileSystemDisk::PUBLIC_UPLOADS->value) {
            if ($currentImagePath && File::exists(public_path($currentImagePath))) {
                File::delete(public_path($currentImagePath));
                return true;
            }
        }

        return false;
    }
}