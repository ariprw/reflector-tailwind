<?php
/**
 * Generate grid utilities.
 */

function reflectorGrid(
    array $grid,
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
    | Grid Template Columns
    |--------------------------------------------------------------------------
    */

    if (isset($grid['cols'])) {

        foreach ($grid['cols'] as $key => $value) {

            $class = "grid-cols-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "grid-template-columns: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Grid Template Rows
    |--------------------------------------------------------------------------
    */

    if (isset($grid['rows'])) {

        foreach ($grid['rows'] as $key => $value) {

            $class = "grid-rows-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "grid-template-rows: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Column Start
    |--------------------------------------------------------------------------
    */

    if (isset($grid['colStart'])) {

        foreach ($grid['colStart'] as $key => $value) {

            $class = "col-start-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "grid-column-start: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Column End
    |--------------------------------------------------------------------------
    */

    if (isset($grid['colEnd'])) {

        foreach ($grid['colEnd'] as $key => $value) {

            $class = "col-end-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "grid-column-end: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Column Span
    |--------------------------------------------------------------------------
    */

    if (isset($grid['colSpan'])) {

        foreach ($grid['colSpan'] as $key => $value) {

            $class = "col-span-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "grid-column: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Row Start
    |--------------------------------------------------------------------------
    */

    if (isset($grid['rowStart'])) {

        foreach ($grid['rowStart'] as $key => $value) {

            $class = "row-start-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "grid-row-start: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Row End
    |--------------------------------------------------------------------------
    */

    if (isset($grid['rowEnd'])) {

        foreach ($grid['rowEnd'] as $key => $value) {

            $class = "row-end-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "grid-row-end: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Row Span
    |--------------------------------------------------------------------------
    */

    if (isset($grid['rowSpan'])) {

        foreach ($grid['rowSpan'] as $key => $value) {

            $class = "row-span-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "grid-row: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Auto Flow
    |--------------------------------------------------------------------------
    */

    if (isset($grid['autoFlow'])) {

        foreach ($grid['autoFlow'] as $key => $value) {

            $class = "grid-flow-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "grid-auto-flow: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Auto Columns
    |--------------------------------------------------------------------------
    */

    if (isset($grid['autoCols'])) {

        foreach ($grid['autoCols'] as $key => $value) {

            $class = "auto-cols-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "grid-auto-columns: {$value};"
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Auto Rows
    |--------------------------------------------------------------------------
    */

    if (isset($grid['autoRows'])) {

        foreach ($grid['autoRows'] as $key => $value) {

            $class = "auto-rows-{$key}";

            $css .= $format(
                ".{$escapeClass($class)}",
                [
                    "grid-auto-rows: {$value};"
                ]
            );
        }
    }

    return $css;
}
