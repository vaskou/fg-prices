<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit77d4b74d0753ae9a2b33ecec1a90347c
{
    public static $files = array (
        'ce86993b4eb8a50284a32cea0e176dc4' => __DIR__ . '/..' . '/vaskou/wordpress-custom-settings/WordpressCustomSettings/bootstrap_2_0_4.php',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit77d4b74d0753ae9a2b33ecec1a90347c::$classMap;

        }, null, ClassLoader::class);
    }
}
