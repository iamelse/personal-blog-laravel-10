<?php

namespace App\Enums;

enum FileSystemDiskEnum: string {
    
    case PUBLIC = "public";
    case PUBLIC_UPLOADS = "public_uploads";
    case IDCLOUDHOST = "idcloudhost";

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }
}