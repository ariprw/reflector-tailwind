<?php
/**
 * Transform Utilities
 *
 * Transform:
 * transform
 * transform-none
 * transform-gpu
 *
 * Transform Style:
 * transform-flat
 * transform-3d
 *
 * Transform Origin:
 * origin-center
 * origin-top
 * origin-top-right
 * origin-right
 * origin-bottom-right
 * origin-bottom
 * origin-bottom-left
 * origin-left
 * origin-top-left
 *
 * Rotate:
 * rotate-0
 * rotate-1
 * rotate-2
 * rotate-3
 * rotate-6
 * rotate-12
 * rotate-45
 * rotate-90
 * rotate-180
 *
 * Negative Rotate:
 * -rotate-1
 * -rotate-2
 * ...
 *
 * Translate:
 * translate-x-4
 * translate-y-4
 *
 * Negative Translate:
 * -translate-x-4
 * -translate-y-4
 *
 * Scale:
 * scale-50
 * scale-75
 * scale-90
 * scale-95
 * scale-100
 * scale-105
 * scale-110
 * scale-125
 * scale-150
 * scale-200
 *
 * Scale X/Y:
 * scale-x-100
 * scale-y-100
 *
 * Skew:
 * skew-x-1
 * skew-x-2
 * skew-x-3
 * skew-x-6
 * skew-x-12
 *
 * skew-y-1
 * skew-y-2
 * skew-y-3
 * skew-y-6
 * skew-y-12
 *
 * Negative Skew:
 * -skew-x-1
 * -skew-y-1
 */


/*
|--------------------------------------------------------------------------
| Transform Generator
|--------------------------------------------------------------------------
*/

function reflectorTransform(
    array $spacing,
    string $mode = 'beautify'
): string {

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
    | Basic Transform
    |--------------------------------------------------------------------------
    |
    | CSS custom properties digunakan agar transform utilities
    | dapat dikombinasikan.
    |
    */

    $basicTransforms = [
        'transform' => [
            'transform: translate(var(--tw-translate-x, 0), var(--tw-translate-y, 0)) rotate(var(--tw-rotate, 0)) skewX(var(--tw-skew-x, 0)) skewY(var(--tw-skew-y, 0)) scaleX(var(--tw-scale-x, 1)) scaleY(var(--tw-scale-y, 1));',
        ],

        'transform-none' => [
            'transform: none;',
        ],

        'transform-gpu' => [
            'transform: translate3d(var(--tw-translate-x, 0), var(--tw-translate-y, 0), 0) rotate(var(--tw-rotate, 0)) skewX(var(--tw-skew-x, 0)) skewY(var(--tw-skew-y, 0)) scaleX(var(--tw-scale-x, 1)) scaleY(var(--tw-scale-y, 1));',
        ],
    ];

    foreach ($basicTransforms as $class => $rules) {

        $css .= $format(
            '.' . $escapeClass($class),
            $rules
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Transform Style
    |--------------------------------------------------------------------------
    */

    $transformStyles = [
        'transform-flat' => 'transform-style: flat;',
        'transform-3d'   => 'transform-style: preserve-3d;',
    ];

    foreach ($transformStyles as $class => $rule) {

        $css .= $format(
            '.' . $escapeClass($class),
            [$rule]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Transform Origin
    |--------------------------------------------------------------------------
    */

    $origins = [
        'center'       => 'center',
        'top'          => 'top',
        'top-right'    => 'top right',
        'right'        => 'right',
        'bottom-right' => 'bottom right',
        'bottom'       => 'bottom',
        'bottom-left'  => 'bottom left',
        'left'         => 'left',
        'top-left'     => 'top left',
    ];

    foreach ($origins as $key => $value) {

        $class = "origin-{$key}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "transform-origin: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Rotate
    |--------------------------------------------------------------------------
    */

    $rotate = [
        '0'   => '0deg',
        '1'   => '1deg',
        '2'   => '2deg',
        '3'   => '3deg',
        '6'   => '6deg',
        '12'  => '12deg',
        '45'  => '45deg',
        '90'  => '90deg',
        '180' => '180deg',
    ];

    foreach ($rotate as $key => $value) {

        /*
        |--------------------------------------------------------------------------
        | Normal Rotate
        |--------------------------------------------------------------------------
        */

        $class = "rotate-{$key}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "--tw-rotate: {$value};"
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Negative Rotate
        |--------------------------------------------------------------------------
        */

        if ($key !== '0') {

            $class = "-rotate-{$key}";

            $negative = "-{$value}";

            $css .= $format(
                '.' . $escapeClass($class),
                [
                    "--tw-rotate: {$negative};"
                ]
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Translate X / Y
    |--------------------------------------------------------------------------
    |
    | Jangan langsung menggunakan:
    |
    | transform: translate(...)
    |
    | karena translate-x dan translate-y harus bisa
    | digunakan bersamaan.
    |
    */

    foreach ($spacing as $key => $value) {

        /*
        |--------------------------------------------------------------------------
        | Translate X
        |--------------------------------------------------------------------------
        */

        $class = "translate-x-{$key}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "--tw-translate-x: {$value};"
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Negative Translate X
        |--------------------------------------------------------------------------
        */

        if (
            $key !== '0'
            &&
            $key !== 'px'
        ) {

            $class = "-translate-x-{$key}";

            $css .= $format(
                '.' . $escapeClass($class),
                [
                    "--tw-translate-x: -{$value};"
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Translate Y
        |--------------------------------------------------------------------------
        */

        $class = "translate-y-{$key}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "--tw-translate-y: {$value};"
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Negative Translate Y
        |--------------------------------------------------------------------------
        */

        if (
            $key !== '0'
            &&
            $key !== 'px'
        ) {

            $class = "-translate-y-{$key}";

            $css .= $format(
                '.' . $escapeClass($class),
                [
                    "--tw-translate-y: -{$value};"
                ]
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Scale
    |--------------------------------------------------------------------------
    */

    $scale = [
        '50'  => '0.5',
        '75'  => '0.75',
        '90'  => '0.9',
        '95'  => '0.95',
        '100' => '1',
        '105' => '1.05',
        '110' => '1.1',
        '125' => '1.25',
        '150' => '1.5',
        '200' => '2',
    ];

    foreach ($scale as $key => $value) {

        /*
        |--------------------------------------------------------------------------
        | Scale
        |--------------------------------------------------------------------------
        */

        $class = "scale-{$key}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "--tw-scale-x: {$value};",
                "--tw-scale-y: {$value};",
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Scale X
        |--------------------------------------------------------------------------
        */

        $class = "scale-x-{$key}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "--tw-scale-x: {$value};"
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Scale Y
        |--------------------------------------------------------------------------
        */

        $class = "scale-y-{$key}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "--tw-scale-y: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Skew X / Y
    |--------------------------------------------------------------------------
    */

    $skew = [
        '0'  => '0deg',
        '1'  => '1deg',
        '2'  => '2deg',
        '3'  => '3deg',
        '6'  => '6deg',
        '12' => '12deg',
    ];

    foreach ($skew as $key => $value) {

        /*
        |--------------------------------------------------------------------------
        | Skew X
        |--------------------------------------------------------------------------
        */

        $class = "skew-x-{$key}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "--tw-skew-x: {$value};"
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Negative Skew X
        |--------------------------------------------------------------------------
        */

        if ($key !== '0') {

            $class = "-skew-x-{$key}";

            $css .= $format(
                '.' . $escapeClass($class),
                [
                    "--tw-skew-x: -{$value};"
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Skew Y
        |--------------------------------------------------------------------------
        */

        $class = "skew-y-{$key}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "--tw-skew-y: {$value};"
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Negative Skew Y
        |--------------------------------------------------------------------------
        */

        if ($key !== '0') {

            $class = "-skew-y-{$key}";

            $css .= $format(
                '.' . $escapeClass($class),
                [
                    "--tw-skew-y: -{$value};"
                ]
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Return
    |--------------------------------------------------------------------------
    */

    return $css;
}

?>
