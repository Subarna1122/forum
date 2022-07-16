<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6e5f2034a163eb07f7d35dc9064e4366
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6e5f2034a163eb07f7d35dc9064e4366::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6e5f2034a163eb07f7d35dc9064e4366::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6e5f2034a163eb07f7d35dc9064e4366::$classMap;

        }, null, ClassLoader::class);
    }
}