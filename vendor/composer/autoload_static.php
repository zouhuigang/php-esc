<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6f265172922ae99ac01780b048432b14
{
    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'package\\phpesc\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'package\\phpesc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/package/phpesc',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6f265172922ae99ac01780b048432b14::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6f265172922ae99ac01780b048432b14::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
