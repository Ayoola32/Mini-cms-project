<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6dbd91b43395c8fd14068f55489d0414
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'M' => 
        array (
            'Mac\\Cms-project-git\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Mac\\Cms-project-git\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit6dbd91b43395c8fd14068f55489d0414::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6dbd91b43395c8fd14068f55489d0414::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6dbd91b43395c8fd14068f55489d0414::$classMap;

        }, null, ClassLoader::class);
    }
}