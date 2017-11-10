<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita2766e4ad0648214a85008f76a3e4eca
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Swolf\\' => 6,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Swolf\\' => 
        array (
            0 => __DIR__ . '/../..' . '/system',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita2766e4ad0648214a85008f76a3e4eca::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita2766e4ad0648214a85008f76a3e4eca::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
