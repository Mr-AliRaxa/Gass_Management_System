<?php

namespace App\Helpers;

use ArPHP\I18N\Arabic;

class ArabicHelper
{
    protected static ?Arabic $arabic = null;

    /**
     * Shape text if it contains Arabic characters for proper Dompdf rendering.
     * If pure English/Latin, returns as-is.
     *
     * @param string|null $text
     * @return string
     */
    public static function shape(?string $text): string
    {
        if ($text === null || $text === '') {
            return '';
        }

        // Check if string contains Arabic characters (U+0600 to U+06FF)
        if (preg_match('/[\x{0600}-\x{06FF}]/u', $text)) {
            if (self::$arabic === null) {
                self::$arabic = new Arabic();
            }
            return self::$arabic->utf8Glyphs($text);
        }

        return $text;
    }

    /**
     * Determine if a string contains Arabic characters.
     *
     * @param string|null $text
     * @return bool
     */
    public static function hasArabic(?string $text): bool
    {
        if ($text === null || $text === '') {
            return false;
        }

        return (bool) preg_match('/[\x{0600}-\x{06FF}]/u', $text);
    }
}
