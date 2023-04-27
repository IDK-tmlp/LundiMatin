<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit78a215e6f9375970453158a86af2d523
{
    public static $prefixLengthsPsr4 = array (
        'J' => 
        array (
            'Jordan\\Test\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Jordan\\Test\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit78a215e6f9375970453158a86af2d523::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit78a215e6f9375970453158a86af2d523::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit78a215e6f9375970453158a86af2d523::$classMap;

        }, null, ClassLoader::class);
    }
}
