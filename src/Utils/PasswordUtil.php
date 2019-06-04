<?php
declare(strict_types=1);

namespace App\Utils;

final class PasswordUtil
{
    public static function generate(int $length = 8): string
    {
        return \bin2hex(\random_bytes($length));
    }

    /**
     * This class should not be instantiated.
     */
    private function __construct()
    {
    }
}
