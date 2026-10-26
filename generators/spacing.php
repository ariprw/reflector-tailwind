<?php
/**
 * Generate spacing utilities.
 *
 * Margin:
 * m-4
 * mx-4
 * my-4
 * mt-4
 * mr-4
 * mb-4
 * ml-4
 *
 * Negative margin:
 * -m-4
 * -mx-4
 * -my-4
 * -mt-4
 * -mr-4
 * -mb-4
 * -ml-4
 *
 * Padding:
 * p-4
 * px-4
 * py-4
 * pt-4
 * pr-4
 * pb-4
 * pl-4
 *
 * Gap:
 * gap-4
 * gap-x-4
 * gap-y-4
 *
 * Decimal values:
 * m-1.5
 * -mt-1.5
 * pl-1.5
 * gap-1.5
 *
 * CSS output:
 * .m-1\.5
 * .-mt-1\.5
 * .pl-1\.5
 * .gap-1\.5
 */

function reflectorSpacing(array $spacing, string $mode = 'beautify'): string
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
    |
    | HTML:
    |
    | pl-1.5
    |
    | CSS:
    |
    | .pl-1\.5
    |
    | Ini penting karena "." memiliki arti khusus di CSS selector.
    |
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
    | Margin / Padding Sides
    |--------------------------------------------------------------------------
    */

    $sides = [
        ''  => null,
        'x' => ['left', 'right'],
        'y' => ['top', 'bottom'],
        't' => ['top'],
        'r' => ['right'],
        'b' => ['bottom'],
        'l' => ['left'],
    ];


    /*
    |--------------------------------------------------------------------------
    | Generate Spacing
    |--------------------------------------------------------------------------
    */

    foreach ($spacing as $key => $value) {

        /*
        |--------------------------------------------------------------------------
        | Margin
        |--------------------------------------------------------------------------
        */

        foreach ($sides as $prefix => $properties) {

            $class = "m{$prefix}-{$key}";


            /*
            |------------------------------------------------------------------
            | Margin Normal
            |------------------------------------------------------------------
            */

            if ($properties === null) {

                $rules = [
                    "margin: {$value};"
                ];

            } else {

                $rules = [];

                foreach ($properties as $property) {
                    $rules[] = "margin-{$property}: {$value};";
                }
            }


            $css .= $format(
                "." . $escapeClass($class),
                $rules
            );


            /*
            |------------------------------------------------------------------
            | Negative Margin
            |------------------------------------------------------------------
            |
            | Tailwind style:
            |
            | -m-1
            | -mt-2
            | -mx-4
            |
            | Padding TIDAK dibuat negative.
            |
            */

            if ($key !== '0' && $key !== 'px') {

                $negative = "-{$value}";

                $class = "-m{$prefix}-{$key}";


                if ($properties === null) {

                    $rules = [
                        "margin: {$negative};"
                    ];

                } else {

                    $rules = [];

                    foreach ($properties as $property) {
                        $rules[] = "margin-{$property}: {$negative};";
                    }
                }


                $css .= $format(
                    "." . $escapeClass($class),
                    $rules
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Padding
        |--------------------------------------------------------------------------
        */

        foreach ($sides as $prefix => $properties) {

            $class = "p{$prefix}-{$key}";


            if ($properties === null) {

                $rules = [
                    "padding: {$value};"
                ];

            } else {

                $rules = [];

                foreach ($properties as $property) {
                    $rules[] = "padding-{$property}: {$value};";
                }
            }


            $css .= $format(
                "." . $escapeClass($class),
                $rules
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Gap
        |--------------------------------------------------------------------------
        */

        $class = "gap-{$key}";

        $css .= $format(
            "." . $escapeClass($class),
            [
                "gap: {$value};"
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Column Gap
        |--------------------------------------------------------------------------
        */

        $class = "gap-x-{$key}";

        $css .= $format(
            "." . $escapeClass($class),
            [
                "column-gap: {$value};"
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Row Gap
        |--------------------------------------------------------------------------
        */

        $class = "gap-y-{$key}";

        $css .= $format(
            "." . $escapeClass($class),
            [
                "row-gap: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Auto Margin
    |--------------------------------------------------------------------------
    |
    | Support:
    |
    | .m-auto
    | .mx-auto
    | .my-auto
    | .mt-auto
    | .mr-auto
    | .mb-auto
    | .ml-auto
    |
    */

    foreach ($sides as $prefix => $properties) {

        $class = "m{$prefix}-auto";

        if ($properties === null) {

            $rules = [
                "margin: auto;"
            ];

        } else {

            $rules = [];

            foreach ($properties as $property) {
                $rules[] = "margin-{$property}: auto;";
            }
        }

        $css .= $format(
            "." . $escapeClass($class),
            $rules
        );
    }

    return $css;
}

?>
