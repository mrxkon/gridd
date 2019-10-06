<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6d03867fc64c41f2fed04ef2527f431c
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WPTRT\\Customize\\Control\\' => 24,
        ),
        'K' => 
        array (
            'Kirki\\Util\\' => 11,
            'Kirki\\Settings\\' => 15,
            'Kirki\\Module\\' => 13,
            'Kirki\\Field\\' => 12,
            'Kirki\\Data\\' => 11,
            'Kirki\\Control\\' => 14,
            'Kirki\\Compatibility\\' => 20,
            'Kirki\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WPTRT\\Customize\\Control\\' => 
        array (
            0 => __DIR__ . '/..' . '/wptrt/control-color-alpha/src',
        ),
        'Kirki\\Util\\' => 
        array (
            0 => __DIR__ . '/..' . '/kirki-framework/control-dashicons/src/Util',
            1 => __DIR__ . '/..' . '/kirki-framework/field-color-palette/src/Util',
            2 => __DIR__ . '/..' . '/kirki-framework/util/src',
        ),
        'Kirki\\Settings\\' => 
        array (
            0 => __DIR__ . '/..' . '/kirki-framework/control-repeater/src/Settings',
        ),
        'Kirki\\Module\\' => 
        array (
            0 => __DIR__ . '/..' . '/kirki-framework/module-webfonts/src',
            1 => __DIR__ . '/..' . '/kirki-framework/module-css/src',
            2 => __DIR__ . '/..' . '/kirki-framework/module-editor-styles/src',
            3 => __DIR__ . '/..' . '/kirki-framework/module-field-dependencies/src',
            4 => __DIR__ . '/..' . '/kirki-framework/module-postmessage/src',
            5 => __DIR__ . '/..' . '/kirki-framework/module-preset/src',
            6 => __DIR__ . '/..' . '/kirki-framework/module-selective-refresh/src',
            7 => __DIR__ . '/..' . '/kirki-framework/module-tooltips/src',
        ),
        'Kirki\\Field\\' => 
        array (
            0 => __DIR__ . '/..' . '/kirki-framework/control-code/src/Field',
            1 => __DIR__ . '/..' . '/kirki-framework/control-dashicons/src/Field',
            2 => __DIR__ . '/..' . '/kirki-framework/control-date/src/Field',
            3 => __DIR__ . '/..' . '/kirki-framework/control-editor/src/Field',
            4 => __DIR__ . '/..' . '/kirki-framework/control-multicheck/src/Field',
            5 => __DIR__ . '/..' . '/kirki-framework/control-radio/src/Field',
            6 => __DIR__ . '/..' . '/kirki-framework/control-palette/src/Field',
            7 => __DIR__ . '/..' . '/kirki-framework/control-select/src/Field',
            8 => __DIR__ . '/..' . '/kirki-framework/control-image/src/Field',
            9 => __DIR__ . '/..' . '/kirki-framework/control-generic/src/Field',
            10 => __DIR__ . '/..' . '/kirki-framework/control-color/src/Field',
            11 => __DIR__ . '/..' . '/kirki-framework/control-checkbox/src/Field',
            12 => __DIR__ . '/..' . '/kirki-framework/control-repeater/src/Field',
            13 => __DIR__ . '/..' . '/kirki-framework/control-slider/src/Field',
            14 => __DIR__ . '/..' . '/kirki-framework/control-sortable/src/Field',
            15 => __DIR__ . '/..' . '/kirki-framework/control-upload/src/Field',
            16 => __DIR__ . '/..' . '/kirki-framework/field-background/src',
            17 => __DIR__ . '/..' . '/kirki-framework/control-react-color/src/Field',
            18 => __DIR__ . '/..' . '/kirki-framework/field-color-palette/src/Field',
            19 => __DIR__ . '/..' . '/kirki-framework/control-dimension/src/Field',
            20 => __DIR__ . '/..' . '/kirki-framework/field-dimensions/src',
            21 => __DIR__ . '/..' . '/kirki-framework/field-fontawesome/src/Field',
            22 => __DIR__ . '/..' . '/kirki-framework/field-multicolor/src/Field',
            23 => __DIR__ . '/..' . '/kirki-framework/control-react-select/src/Field',
            24 => __DIR__ . '/..' . '/kirki-framework/control-custom/src/Field',
            25 => __DIR__ . '/..' . '/kirki-framework/field-typography/src/Field',
        ),
        'Kirki\\Data\\' => 
        array (
            0 => __DIR__ . '/..' . '/kirki-framework/data-option/src',
        ),
        'Kirki\\Control\\' => 
        array (
            0 => __DIR__ . '/..' . '/kirki-framework/control-code/src/Control',
            1 => __DIR__ . '/..' . '/kirki-framework/control-cropped-image/src',
            2 => __DIR__ . '/..' . '/kirki-framework/control-base/src/Control',
            3 => __DIR__ . '/..' . '/kirki-framework/control-dashicons/src/Control',
            4 => __DIR__ . '/..' . '/kirki-framework/control-date/src/Control',
            5 => __DIR__ . '/..' . '/kirki-framework/control-editor/src/Control',
            6 => __DIR__ . '/..' . '/kirki-framework/control-multicheck/src/Control',
            7 => __DIR__ . '/..' . '/kirki-framework/control-radio/src/Control',
            8 => __DIR__ . '/..' . '/kirki-framework/control-palette/src/Control',
            9 => __DIR__ . '/..' . '/kirki-framework/control-select/src/Control',
            10 => __DIR__ . '/..' . '/kirki-framework/control-image/src/Control',
            11 => __DIR__ . '/..' . '/kirki-framework/control-generic/src/Control',
            12 => __DIR__ . '/..' . '/kirki-framework/control-color/src/Control',
            13 => __DIR__ . '/..' . '/kirki-framework/control-checkbox/src/Control',
            14 => __DIR__ . '/..' . '/kirki-framework/control-repeater/src/Control',
            15 => __DIR__ . '/..' . '/kirki-framework/control-slider/src/Control',
            16 => __DIR__ . '/..' . '/kirki-framework/control-sortable/src/Control',
            17 => __DIR__ . '/..' . '/kirki-framework/control-react-color/src/Control',
            18 => __DIR__ . '/..' . '/kirki-framework/control-dimension/src/Control',
            19 => __DIR__ . '/..' . '/kirki-framework/field-multicolor/src/Control',
            20 => __DIR__ . '/..' . '/kirki-framework/control-react-select/src/Control',
            21 => __DIR__ . '/..' . '/kirki-framework/control-custom/src/Control',
            22 => __DIR__ . '/..' . '/kirki-framework/field-typography/src/Control',
        ),
        'Kirki\\Compatibility\\' => 
        array (
            0 => __DIR__ . '/..' . '/kirki-framework/compatibility/src',
        ),
        'Kirki\\' => 
        array (
            0 => __DIR__ . '/..' . '/kirki-framework/field/src',
            1 => __DIR__ . '/..' . '/kirki-framework/url-getter/src',
            2 => __DIR__ . '/..' . '/kirki-framework/googlefonts/src',
            3 => __DIR__ . '/..' . '/kirki-framework/l10n/src',
            4 => __DIR__ . '/..' . '/kirki-framework/module-panels/src',
            5 => __DIR__ . '/..' . '/kirki-framework/module-sections/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6d03867fc64c41f2fed04ef2527f431c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6d03867fc64c41f2fed04ef2527f431c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
