<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit043456b4a33884a68c211ef30b7ddc1c
{
    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'think\\composer\\' => 15,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'think\\composer\\' => 
        array (
            0 => __DIR__ . '/..' . '/topthink/think-installer/src',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit043456b4a33884a68c211ef30b7ddc1c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit043456b4a33884a68c211ef30b7ddc1c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
