<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit77d4b74d0753ae9a2b33ecec1a90347c
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WordpressCustomSettings\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WordpressCustomSettings\\' => 
        array (
            0 => __DIR__ . '/..' . '/vaskou/wordpress-custom-settings/WordpressCustomSettings',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit77d4b74d0753ae9a2b33ecec1a90347c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit77d4b74d0753ae9a2b33ecec1a90347c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit77d4b74d0753ae9a2b33ecec1a90347c::$classMap;

        }, null, ClassLoader::class);
    }
}