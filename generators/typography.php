<?php
/**
 * Generate typography utilities.
 *
 * Font Size:
 * text-xs
 * text-sm
 * text-base
 * text-lg
 * text-xl
 * text-2xl
 * ...
 *
 * Font Weight:
 * font-thin
 * font-extralight
 * font-light
 * font-normal
 * font-medium
 * font-semibold
 * font-bold
 * font-extrabold
 * font-black
 *
 * Line Height:
 * leading-none
 * leading-tight
 * leading-snug
 * leading-normal
 * leading-relaxed
 * leading-loose
 *
 * Letter Spacing:
 * tracking-tighter
 * tracking-tight
 * tracking-normal
 * tracking-wide
 * tracking-wider
 * tracking-widest
 *
 * Font Style:
 * italic
 * not-italic
 *
 * Text Transform:
 * uppercase
 * lowercase
 * capitalize
 * normal-case
 *
 * Text Align:
 * text-left
 * text-center
 * text-right
 * text-justify
 *
 * Text Decoration:
 * underline
 * overline
 * line-through
 * no-underline
 */

function reflectorTypography(
    array $typography,
    string $mode = 'beautify'
): string {

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
    | Escape CSS Class
    |--------------------------------------------------------------------------
    */

    $escapeClass = function (string $class): string {

        return str_replace(
            ['\\', '.', ':', '/', '[', ']', '%'],
            ['\\\\', '\\.', '\\:', '\\/', '\\[', '\\]', '\\%'],
            $class
        );
    };

    /*
    |--------------------------------------------------------------------------
    | Font Size
    |--------------------------------------------------------------------------
    */

    if (isset($typography['fontSize'])) {

        foreach ($typography['fontSize'] as $key => $value) {

            $class = "text-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "font-size: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Font Weight
    |--------------------------------------------------------------------------
    */

    if (isset($typography['fontWeight'])) {

        foreach ($typography['fontWeight'] as $key => $value) {

            $class = "font-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "font-weight: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Line Height
    |--------------------------------------------------------------------------
    */

    if (isset($typography['lineHeight'])) {

        foreach ($typography['lineHeight'] as $key => $value) {

            $class = "leading-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "line-height: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Letter Spacing
    |--------------------------------------------------------------------------
    */

    if (isset($typography['letterSpacing'])) {

        foreach ($typography['letterSpacing'] as $key => $value) {

            $class = "tracking-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "letter-spacing: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Font Style
    |--------------------------------------------------------------------------
    */

    $fontStyles = [
        'italic'     => 'italic',
        'not-italic' => 'normal',
    ];

    foreach ($fontStyles as $class => $value) {

        $css .= $format(
            ".{$escapeClass($class)}",
            [
                "font-style: {$value};"
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Text Transform
    |--------------------------------------------------------------------------
    */

    $textTransforms = [
        'uppercase'   => 'uppercase',
        'lowercase'   => 'lowercase',
        'capitalize'  => 'capitalize',
        'normal-case' => 'none',
    ];

    foreach ($textTransforms as $class => $value) {

        $css .= $format(
            ".{$escapeClass($class)}",
            [
                "text-transform: {$value};"
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Text Align
    |--------------------------------------------------------------------------
    */

    $textAlign = [
        'text-left'    => 'left',
        'text-center'  => 'center',
        'text-right'   => 'right',
        'text-justify' => 'justify',
    ];

    foreach ($textAlign as $class => $value) {

        $css .= $format(
            ".{$escapeClass($class)}",
            [
                "text-align: {$value};"
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Text Decoration
    |--------------------------------------------------------------------------
    */

    $textDecoration = [
        'underline'    => 'underline',
        'overline'     => 'overline',
        'line-through' => 'line-through',
        'no-underline' => 'none',
    ];

    foreach ($textDecoration as $class => $value) {

        $css .= $format(
            ".{$escapeClass($class)}",
            [
                "text-decoration-line: {$value};"
            ]
        );
    }

    return $css;
}