<?php
/**
 * Generate screen reader utilities.
 *
 * Classes:
 * sr-only
 * not-sr-only
 */

function reflectorSrOnly(
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
    | Screen Reader Only
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.sr-only',
        [
            'position: absolute;',
            'width: 1px;',
            'height: 1px;',
            'padding: 0;',
            'margin: -1px;',
            'overflow: hidden;',
            'clip: rect(0, 0, 0, 0);',
            'white-space: nowrap;',
            'border-width: 0;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Not Screen Reader Only
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.not-sr-only',
        [
            'position: static;',
            'width: auto;',
            'height: auto;',
            'padding: 0;',
            'margin: 0;',
            'overflow: visible;',
            'clip: auto;',
            'white-space: normal;',
        ]
    );


    return $css;
}