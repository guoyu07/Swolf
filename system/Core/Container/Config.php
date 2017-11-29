<?php
//MIT License
//
//Copyright (c) 2017 清和
//
//Permission is hereby granted, free of charge, to any person obtaining a copy
//of this software and associated documentation files (the "Software"), to deal
//in the Software without restriction, including without limitation the rights
//to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
//copies of the Software, and to permit persons to whom the Software is
//furnished to do so, subject to the following conditions:
//
//The above copyright notice and this permission notice shall be included in all
//copies or substantial portions of the Software.
//
//THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
//IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
//FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
//AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
//                                           LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
//OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
//SOFTWARE.

namespace Swolf\Core\Container;

class Config
{

    protected static $config = [];

    public static function get($key)
    {
        $key = trim($key, '.');
        if (strpos($key, '.') === false) {
            return isset(self::$config[$key]) ? self::$config[$key] : null;
        }
        $keyArr = explode('.', $key);
        $config = self::$config;
        foreach ($keyArr as $k) {
            if (!isset($config[$k])) {
                return null;
            }
            $config = $config[$k];
        }
        return $config;
    }

    public static function set($key, $value)
    {
        $key = trim($key, '.');
        if (strpos($key, '.') === false) {
            self::$config[$key] = $value;
            return;
        }
        $keyArr = explode('.', $key);
        $finalKey = end($keyArr);
        $keyArr = array_slice($keyArr, 0, count($keyArr) - 1);
        $config = &self::$config;
        foreach ($keyArr as $k) {
            $config[$k] = [];
            $config = &$config[$k];
        }
        $config[$finalKey] = $value;
    }

    public static function isset($key)
    {
        $key = trim($key, '.');
        if (strpos($key, '.') === false) {
            return isset(self::$config[$key]);
        }
        $keyArr = explode('.', $key);
        $config = self::$config;
        foreach ($keyArr as $k) {
            if (!isset($config[$k])) {
                return false;
            }
            $config = $config[$k];
        }
        return true;
    }


    public static function setBatch($arrayConfig)
    {
        foreach ($arrayConfig as $item => $value) {
            self::$config[$item] = $value;
        }
    }


}