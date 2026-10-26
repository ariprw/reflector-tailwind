<?php
/**
 * Generate Tailwind-like sizing utilities.
 *
 * Width:
 * w-0
 * w-px
 * w-0.5
 * w-1
 * w-1.5
 * w-2
 * ...
 * w-96
 * w-auto
 * w-full
 * w-screen
 * w-svw
 * w-lvw
 * w-dvw
 * w-min
 * w-max
 * w-fit
 *
 * Fraction:
 * w-1/2
 * w-1/3
 * w-2/3
 * w-1/4
 * ...
 *
 * Height:
 * h-*
 *
 * Min Width:
 * min-w-*
 *
 * Max Width:
 * max-w-*
 *
 * Min Height:
 * min-h-*
 *
 * Max Height:
 * max-h-*
 *
 * Arbitrary:
 * w-[250px]
 * h-[50vh]
 * min-w-[300px]
 * max-w-[1200px]
 */

function reflectorSizing(array $spacing, string $mode = 'beautify'): string
{
    $css = '';

    /*
    |--------------------------------------------------------------------------
    | Formatter
    |--------------------------------------------------------------------------
    */

    $format = function (
        string $selector,
        array $rules
    ) use ($mode): string {

        if ($mode === 'minify') {
            return $selector . '{' . implode('', $rules) . '}';
        }

        $out = $selector . " {\n";

        foreach ($rules as $rule) {
            $out .= "    {$rule}\n";
        }

        return $out . "}\n";
    };

    /*
    |--------------------------------------------------------------------------
    | Escape Tailwind-like class
    |--------------------------------------------------------------------------
    */

    $escapeClass = function (string $class): string {

        return str_replace(
            [
                '\\',
                '.',
                ':',
                '/',
                '[',
                ']',
                '%',
                '#',
                '(',
                ')',
                ',',
            ],
            [
                '\\\\',
                '\\.',
                '\\:',
                '\\/',
                '\\[',
                '\\]',
                '\\%',
                '\\#',
                '\\(',
                '\\)',
                '\\,',
            ],
            $class
        );
    };

    /*
    |--------------------------------------------------------------------------
    | Base Width / Height
    |--------------------------------------------------------------------------
    */

    $baseValues = $spacing;

    /*
    |--------------------------------------------------------------------------
    | Special sizing values
    |--------------------------------------------------------------------------
    */

    $specialValues = [

        'auto'   => 'auto',

        'px'     => '1px',

        'full'   => '100%',

        'screen' => '100vw',

        'svw'    => '100svw',

        'lvw'    => '100lvw',

        'dvw'    => '100dvw',

        'min'    => 'min-content',

        'max'    => 'max-content',

        'fit'    => 'fit-content',

    ];

    /*
    |--------------------------------------------------------------------------
    | Height special values
    |--------------------------------------------------------------------------
    */

    $heightSpecialValues = [

        'auto'   => 'auto',

        'px'     => '1px',

        'full'   => '100%',

        'screen' => '100vh',

        'svh'    => '100svh',

        'lvh'    => '100lvh',

        'dvh'    => '100dvh',

        'min'    => 'min-content',

        'max'    => 'max-content',

        'fit'    => 'fit-content',

    ];

    /*
    |--------------------------------------------------------------------------
    | Width
    |--------------------------------------------------------------------------
    */

    foreach ($baseValues as $key => $value) {

        $class = $escapeClass("w-{$key}");

        $css .= $format(
            ".{$class}",
            [
                "width: {$value};"
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Height
    |--------------------------------------------------------------------------
    */

    foreach ($baseValues as $key => $value) {

        $class = $escapeClass("h-{$key}");

        $css .= $format(
            ".{$class}",
            [
                "height: {$value};"
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Width Special
    |--------------------------------------------------------------------------
    */

    foreach ($specialValues as $key => $value) {

        $class = $escapeClass("w-{$key}");

        $css .= $format(
            ".{$class}",
            [
                "width: {$value};"
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Height Special
    |--------------------------------------------------------------------------
    */

    foreach ($heightSpecialValues as $key => $value) {

        $class = $escapeClass("h-{$key}");

        $css .= $format(
            ".{$class}",
            [
                "height: {$value};"
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Fractions
    |--------------------------------------------------------------------------
    */

    $fractions = [

        '1/2' => '50%',

        '1/3' => '33.333333%',

        '2/3' => '66.666667%',

        '1/4' => '25%',

        '2/4' => '50%',

        '3/4' => '75%',

        '1/5' => '20%',

        '2/5' => '40%',

        '3/5' => '60%',

        '4/5' => '80%',

        '1/6' => '16.666667%',

        '2/6' => '33.333333%',

        '3/6' => '50%',

        '4/6' => '66.666667%',

        '5/6' => '83.333333%',

        '1/12' => '8.333333%',

        '2/12' => '16.666667%',

        '3/12' => '25%',

        '4/12' => '33.333333%',

        '5/12' => '41.666667%',

        '6/12' => '50%',

        '7/12' => '58.333333%',

        '8/12' => '66.666667%',

        '9/12' => '75%',

        '10/12' => '83.333333%',

        '11/12' => '91.666667%',
    ];

    foreach ($fractions as $key => $value) {

        $escaped = $escapeClass("w-{$key}");

        $css .= $format(
            ".{$escaped}",
            [
                "width: {$value};"
            ]
        );

        $escaped = $escapeClass("h-{$key}");

        $css .= $format(
            ".{$escaped}",
            [
                "height: {$value};"
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Min Width
    |--------------------------------------------------------------------------
    */

    foreach ($baseValues as $key => $value) {

        $class = $escapeClass("min-w-{$key}");

        $css .= $format(
            ".{$class}",
            [
                "min-width: {$value};"
            ]
        );
    }

    foreach ($specialValues as $key => $value) {

        $class = $escapeClass("min-w-{$key}");

        $css .= $format(
            ".{$class}",
            [
                "min-width: {$value};"
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Max Width
    |--------------------------------------------------------------------------
    */

    foreach ($baseValues as $key => $value) {

        $class = $escapeClass("max-w-{$key}");

        $css .= $format(
            ".{$class}",
            [
                "max-width: {$value};"
            ]
        );
    }

    foreach ($specialValues as $key => $value) {

        $class = $escapeClass("max-w-{$key}");

        $css .= $format(
            ".{$class}",
            [
                "max-width: {$value};"
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Min Height
    |--------------------------------------------------------------------------
    */

    foreach ($baseValues as $key => $value) {

        $class = $escapeClass("min-h-{$key}");

        $css .= $format(
            ".{$class}",
            [
                "min-height: {$value};"
            ]
        );
    }

    foreach ($heightSpecialValues as $key => $value) {

        $class = $escapeClass("min-h-{$key}");

        $css .= $format(
            ".{$class}",
            [
                "min-height: {$value};"
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Max Height
    |--------------------------------------------------------------------------
    */

    foreach ($baseValues as $key => $value) {

        $class = $escapeClass("max-h-{$key}");

        $css .= $format(
            ".{$class}",
            [
                "max-height: {$value};"
            ]
        );
    }

    foreach ($heightSpecialValues as $key => $value) {

        $class = $escapeClass("max-h-{$key}");

        $css .= $format(
            ".{$class}",
            [
                "max-height: {$value};"
            ]
        );
    }

    return $css;
}
