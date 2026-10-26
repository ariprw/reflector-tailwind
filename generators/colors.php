<?php
/**
 * Generate Tailwind-like color utilities.
 *
 * Supported:
 *
 * Text:
 * text-red-500
 *
 * Background:
 * bg-red-500
 *
 * Border:
 * border-red-500
 *
 * Hover:
 * hover:text-red-500
 * hover:bg-red-500
 * hover:border-red-500
 */

function reflectorColors(array $colors, string $mode = 'beautify'): string
{
    $css = '';

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
    | Escape Tailwind Class
    |--------------------------------------------------------------------------
    */

    $escapeClass = function (string $class): string {
        return str_replace(
            ['\\', '.', ':', '/', '[', ']', '%', '!', '#', ','],
            [
                '\\\\',
                '\\.',
                '\\:',
                '\\/',
                '\\[',
                '\\]',
                '\\%',
                '\\!',
                '\\#',
                '\\,'
            ],
            $class
        );
    };

    /*
    |--------------------------------------------------------------------------
    | Generate Colors
    |--------------------------------------------------------------------------
    */

    foreach ($colors as $name => $shades) {

        /*
        |--------------------------------------------------------------------------
        | Simple color
        |
        | Example:
        | white
        | black
        | dark
        |--------------------------------------------------------------------------
        */

        if (!is_array($shades)) {

            $value = $shades;

            /*
            | text-white
            */

            $css .= $format(
                '.text-' . $escapeClass($name),
                [
                    "color: {$value};"
                ]
            );

            /*
            | bg-white
            */

            $css .= $format(
                '.bg-' . $escapeClass($name),
                [
                    "background-color: {$value};"
                ]
            );

            /*
            | border-white
            */

            $css .= $format(
                '.border-' . $escapeClass($name),
                [
                    "border-color: {$value};"
                ]
            );

            /*
            | hover:text-white
            */

            $hoverText = $escapeClass("hover:text-{$name}");

            $css .= $format(
                ".{$hoverText}:hover",
                [
                    "color: {$value};"
                ]
            );

            /*
            | hover:bg-white
            */

            $hoverBg = $escapeClass("hover:bg-{$name}");

            $css .= $format(
                ".{$hoverBg}:hover",
                [
                    "background-color: {$value};"
                ]
            );

            /*
            | hover:border-white
            */

            /**
            $hoverBorder = $escapeClass("hover:border-{$name}");

            $css .= $format(
                ".{$hoverBorder}:hover",
                [
                    "border-color: {$value};"
                ]
            );
            **/

            continue;
        }

        /*
        |--------------------------------------------------------------------------
        | Color Shades
        |
        | Example:
        | red-50
        | red-100
        | red-500
        | red-950
        |--------------------------------------------------------------------------
        */

        foreach ($shades as $shade => $value) {

            /*
            | DEFAULT
            |
            | Example:
            | dark.DEFAULT
            |
            | becomes:
            | text-dark
            | bg-dark
            | border-dark
            |--------------------------------------------------------------------------
            */

            if ($shade === 'DEFAULT') {
                $colorName = $name;
            } else {
                $colorName = "{$name}-{$shade}";
            }

            /*
            |--------------------------------------------------------------------------
            | Text
            |--------------------------------------------------------------------------
            */

            $css .= $format(
                '.text-' . $escapeClass($colorName),
                [
                    "color: {$value};"
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Background
            |--------------------------------------------------------------------------
            */

            $css .= $format(
                '.bg-' . $escapeClass($colorName),
                [
                    "background-color: {$value};"
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Border
            |--------------------------------------------------------------------------
            */

            $css .= $format(
                '.border-' . $escapeClass($colorName),
                [
                    "border-color: {$value};"
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Hover Text
            |--------------------------------------------------------------------------
            */

            $hoverText = $escapeClass(
                "hover:text-{$colorName}"
            );

            $css .= $format(
                ".{$hoverText}:hover",
                [
                    "color: {$value};"
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Hover Background
            |--------------------------------------------------------------------------
            */

            $hoverBg = $escapeClass(
                "hover:bg-{$colorName}"
            );

            $css .= $format(
                ".{$hoverBg}:hover",
                [
                    "background-color: {$value};"
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Hover Border
            |--------------------------------------------------------------------------
            */

            /**
            $hoverBorder = $escapeClass(
                "hover:border-{$colorName}"
            );

            $css .= $format(
                ".{$hoverBorder}:hover",
                [
                    "border-color: {$value};"
                ]
            );
            **/
        }
    }

    return $css;
}