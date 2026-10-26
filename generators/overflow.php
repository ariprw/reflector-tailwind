<?php
/**
 * Generate overflow utilities.
 *
 * overflow:
 * overflow-auto
 * overflow-hidden
 * overflow-clip
 * overflow-visible
 * overflow-scroll
 *
 * overflow-x-auto
 * overflow-x-hidden
 * overflow-x-clip
 * overflow-x-visible
 * overflow-x-scroll
 *
 * overflow-y-auto
 * overflow-y-hidden
 * overflow-y-clip
 * overflow-y-visible
 * overflow-y-scroll
 */

function reflectorOverflow(
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
    | Overflow
    |--------------------------------------------------------------------------
    */

    $overflow = [
        'overflow-auto'    => 'overflow: auto;',
        'overflow-hidden'  => 'overflow: hidden;',
        'overflow-clip'    => 'overflow: clip;',
        'overflow-visible' => 'overflow: visible;',
        'overflow-scroll'  => 'overflow: scroll;',
    ];

    foreach ($overflow as $class => $value) {
        $css .= $format(
            ".{$class}",
            [$value]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Overflow X
    |--------------------------------------------------------------------------
    */

    $overflowX = [
        'overflow-x-auto'    => 'overflow-x: auto;',
        'overflow-x-hidden'  => 'overflow-x: hidden;',
        'overflow-x-clip'    => 'overflow-x: clip;',
        'overflow-x-visible' => 'overflow-x: visible;',
        'overflow-x-scroll'  => 'overflow-x: scroll;',
    ];

    foreach ($overflowX as $class => $value) {
        $css .= $format(
            ".{$class}",
            [$value]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Overflow Y
    |--------------------------------------------------------------------------
    */

    $overflowY = [
        'overflow-y-auto'    => 'overflow-y: auto;',
        'overflow-y-hidden'  => 'overflow-y: hidden;',
        'overflow-y-clip'    => 'overflow-y: clip;',
        'overflow-y-visible' => 'overflow-y: visible;',
        'overflow-y-scroll'  => 'overflow-y: scroll;',
    ];

    foreach ($overflowY as $class => $value) {
        $css .= $format(
            ".{$class}",
            [$value]
        );
    }

    return $css;
}
