<?php

namespace App\Enums;

enum PostStatus: string
{
    case DRAFT = 'draft';
    case SCHEDULED = 'scheduled';
    case PUBLISHED = 'published';
    case ARCHIVE = 'archive';

    public static function values(): array
    {
        return [
            self::DRAFT->value => 'draft',
            self::PUBLISHED->value => 'published',
            self::SCHEDULED->value => 'scheduled',
            self::ARCHIVE->value => 'archive',
        ];
    }
}