<?php

class Session
{
    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public static function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function exists(string $key):bool
    {

        $value = Session::get($key);
        if (isset($value)){
            return true;
        }
        return false;
    }

    /**
     * @param $key
     * @return void
     */
    public static function removeValidationError($key): void
    {
        unset($_SESSION['validation_errors'][$key]);
    }

    /**
     * @param string $key
     * @return void
     */
    public static function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }
}