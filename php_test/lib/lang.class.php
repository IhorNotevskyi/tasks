<?php

class Lang
{
    protected static $data;

    public static function load($langCode)
    {
        $langFilePath = ROOT . DS . 'lang' . DS . strtolower($langCode) . '.php';

        if (file_exists($langFilePath)) {
            self::$data = include $langFilePath;
        } else {
            throw new Exception('Lang file not found: ' . $langFilePath);
        }
    }

    public static function get($key, $defaultValue = '') {
        return isset(self::$data[strtolower($key)]) ? self::$data[strtolower($key)] : $defaultValue;
    }

    public static function getLang($key, $defaultValue = '')
    {
        return self::get($key, $defaultValue);
    }
}