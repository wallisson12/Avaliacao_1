<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9bfbf98aa8987e2c8c8ae840e207a3e5
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Moobi\\Avaliacao\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Moobi\\Avaliacao\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit9bfbf98aa8987e2c8c8ae840e207a3e5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9bfbf98aa8987e2c8c8ae840e207a3e5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9bfbf98aa8987e2c8c8ae840e207a3e5::$classMap;

        }, null, ClassLoader::class);
    }
}
