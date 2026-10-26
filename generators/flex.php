<?php
/**
 * Generate flex utilities.
 */

function reflectorFlex(
    array $flex,
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
    | Flex Direction
    |--------------------------------------------------------------------------
    */

    if (isset($flex['direction'])) {

        foreach ($flex['direction'] as $key => $value) {

            $class = "flex-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "flex-direction: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Flex Wrap
    |--------------------------------------------------------------------------
    */

    if (isset($flex['wrap'])) {

        foreach ($flex['wrap'] as $key => $value) {

            $class = "flex-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "flex-wrap: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Flex
    |--------------------------------------------------------------------------
    */

    if (isset($flex['flex'])) {

        foreach ($flex['flex'] as $key => $value) {

            $class = "flex-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "flex: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Flex Grow
    |--------------------------------------------------------------------------
    */

    if (isset($flex['grow'])) {

        foreach ($flex['grow'] as $key => $value) {

            $class = "grow-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "flex-grow: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Flex Shrink
    |--------------------------------------------------------------------------
    */

    if (isset($flex['shrink'])) {

        foreach ($flex['shrink'] as $key => $value) {

            $class = "shrink-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "flex-shrink: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Justify Content
    |--------------------------------------------------------------------------
    */

    if (isset($flex['justify'])) {

        foreach ($flex['justify'] as $key => $value) {

            $class = "justify-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "justify-content: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Align Items
    |--------------------------------------------------------------------------
    */

    if (isset($flex['items'])) {

        foreach ($flex['items'] as $key => $value) {

            $class = "items-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "align-items: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Align Content
    |--------------------------------------------------------------------------
    */

    if (isset($flex['content'])) {

        foreach ($flex['content'] as $key => $value) {

            $class = "content-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "align-content: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Align Self
    |--------------------------------------------------------------------------
    */

    if (isset($flex['self'])) {

        foreach ($flex['self'] as $key => $value) {

            $class = "self-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "align-self: {$value};"
                ]
            );
        }
    }

    return $css;
}
