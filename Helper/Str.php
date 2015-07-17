<?php

class Str {

    /**
     * Generate a more truly "random" alpha-numeric string. (From Laravel)
     *
     * @param  int  $length
     * @return string
     *
     * @throws \RuntimeException
     */
    public static function random($length = 16)
    {
        $string = '';

        while (($len = strlen($string)) < $length)
        {
            $size = $length - $len;
            $bytes = static::randomBytes($size);
            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $string;
    }

    /**
     * Generate a more truly "random" bytes. (From Laravel)
     *
     * @param  int  $length
     * @return string
     *
     * @throws \RuntimeException
     */
    public static function randomBytes($length = 16)
    {
        if (function_exists('random_bytes'))
        {
            $bytes = random_bytes($length);
        }
        elseif (function_exists('openssl_random_pseudo_bytes'))
        {
            $bytes = openssl_random_pseudo_bytes($length, $strong);
            if ($bytes === false || $strong === false)
            {
                throw new RuntimeException('Unable to generate random string.');
            }
        }
        else
        {
            throw new RuntimeException('OpenSSL extension is required for PHP 5 users.');
        }

        return $bytes;
    }
}