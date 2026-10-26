<?php
/**
 * Transition Utilities
 *
 * Utilities:
 *
 * transition
 * transition-all
 * transition-none
 * transition-colors
 * transition-opacity
 * transition-shadow
 * transition-transform
 *
 * Duration:
 *
 * duration-0
 * duration-75
 * duration-100
 * duration-150
 * duration-200
 * duration-300
 * duration-500
 * duration-700
 * duration-1000
 *
 * Delay:
 *
 * delay-0
 * delay-75
 * delay-100
 * delay-150
 * delay-200
 * delay-300
 * delay-500
 * delay-700
 * delay-1000
 *
 * Timing Function:
 *
 * ease-linear
 * ease-in
 * ease-out
 * ease-in-out
 */


/*
|--------------------------------------------------------------------------
| Transition Generator
|--------------------------------------------------------------------------
*/

function reflectorTransition(string $mode = 'beautify'): string
{
    $css = '';


    /*
    |--------------------------------------------------------------------------
    | Format CSS Rule
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
    | Escape CSS Class
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
                '!',
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
                '\\!',
            ],
            $class
        );
    };


    /*
    |--------------------------------------------------------------------------
    | Transition
    |--------------------------------------------------------------------------
    */

    $transitions = [

        'transition' =>
            'transition-property: color, background-color, border-color, outline-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, translate, scale, rotate, filter, -webkit-backdrop-filter, backdrop-filter;',

        'transition-all' =>
            'transition-property: all;',

        'transition-none' =>
            'transition-property: none;',

        'transition-colors' =>
            'transition-property: color, background-color, border-color, outline-color, text-decoration-color, fill, stroke;',

        'transition-opacity' =>
            'transition-property: opacity;',

        'transition-shadow' =>
            'transition-property: box-shadow;',

        'transition-transform' =>
            'transition-property: transform, translate, scale, rotate;',
    ];


    foreach ($transitions as $class => $rule) {

        $css .= $format(
            '.' . $escapeClass($class),
            [$rule]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Transition Duration
    |--------------------------------------------------------------------------
    */

    $durations = [
        '0'    => '0ms',
        '75'   => '75ms',
        '100'  => '100ms',
        '150'  => '150ms',
        '200'  => '200ms',
        '300'  => '300ms',
        '500'  => '500ms',
        '700'  => '700ms',
        '1000' => '1000ms',
    ];


    foreach ($durations as $key => $value) {

        $class = "duration-{$key}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "transition-duration: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Transition Delay
    |--------------------------------------------------------------------------
    */

    $delays = [
        '0'    => '0ms',
        '75'   => '75ms',
        '100'  => '100ms',
        '150'  => '150ms',
        '200'  => '200ms',
        '300'  => '300ms',
        '500'  => '500ms',
        '700'  => '700ms',
        '1000' => '1000ms',
    ];


    foreach ($delays as $key => $value) {

        $class = "delay-{$key}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "transition-delay: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Timing Function
    |--------------------------------------------------------------------------
    */

    $easing = [
        'linear'   => 'linear',
        'in'       => 'cubic-bezier(0.4, 0, 1, 1)',
        'out'      => 'cubic-bezier(0, 0, 0.2, 1)',
        'in-out'   => 'cubic-bezier(0.4, 0, 0.2, 1)',
    ];


    foreach ($easing as $key => $value) {

        $class = "ease-{$key}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "transition-timing-function: {$value};"
            ]
        );
    }


    return $css;
}
