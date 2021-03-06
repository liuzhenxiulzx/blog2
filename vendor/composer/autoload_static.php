<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit274a5d381257e93dde61a2da6ef1d6ec
{
    public static $files = array (
        '2c102faa651ef8ea5874edb585946bce' => __DIR__ . '/..' . '/swiftmailer/swiftmailer/lib/swift_required.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Predis\\' => 7,
        ),
        'E' => 
        array (
            'Egulias\\EmailValidator\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Predis\\' => 
        array (
            0 => __DIR__ . '/..' . '/predis/predis/src',
        ),
        'Egulias\\EmailValidator\\' => 
        array (
            0 => __DIR__ . '/..' . '/egulias/email-validator/EmailValidator',
        ),
    );

    public static $prefixesPsr0 = array (
        'D' => 
        array (
            'Doctrine\\Common\\Lexer\\' => 
            array (
                0 => __DIR__ . '/..' . '/doctrine/lexer/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit274a5d381257e93dde61a2da6ef1d6ec::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit274a5d381257e93dde61a2da6ef1d6ec::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit274a5d381257e93dde61a2da6ef1d6ec::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
