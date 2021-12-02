<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit17311be18b097f8ce53561d666e0d2f1
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\Access\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\Access\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit17311be18b097f8ce53561d666e0d2f1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit17311be18b097f8ce53561d666e0d2f1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit17311be18b097f8ce53561d666e0d2f1::$classMap;

        }, null, ClassLoader::class);
    }
}
