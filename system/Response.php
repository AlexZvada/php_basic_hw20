<?php


class Response
{
    /**
     * @param string $url
     * @param int|null $code
     * @return never
     */
    public static function redirect(string $url, ?int $code = 302):never
    {
        header("Location: $url", true, $code);
        exit;
    }
}