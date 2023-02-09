<?php

declare(strict_types=1);

namespace Core\Helper;

/**
 * 文件系统 - 助手类.
 */
class FilesystemHelper
{
    public static function getFullPath(string $path): string
    {
        return self::getDomain() . '/' . $path;
    }

    public static function getDomain(): string
    {
        return rtrim(config('file.domain'), '/');
    }
}
