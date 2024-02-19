<?php


class Request
{
    public static function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public static function getUrl(): string
    {
        $url = $_SERVER['REQUEST_URI'];
        if (str_contains($url, "?")){
            $url = substr($url, 0, strpos($url, "?"));
        }
        return $url;
    }
    public static function getReferer(): string
    {
        return $_SERVER['HTTP_REFERER'];
    }

    public static function get(string $key): mixed
    {
        $data=[];
        if (self::getMethod() === 'post'){
            $data = $_POST;
        }elseif (self::getMethod() === 'get'){
            $data = $_GET;
        }
        return $data[$key] ?? null;

    }
}