<?php
/**
 * Generate display utilities.
 *
 * display:
 * block
 * inline-block
 * inline
 * flex
 * inline-flex
 * table
 * inline-table
 * table-caption
 * table-cell
 * table-column
 * table-column-group
 * table-footer-group
 * table-header-group
 * table-row-group
 * table-row
 * flow-root
 * grid
 * inline-grid
 * contents
 * list-item
 * hidden
 */

function reflectorDisplay(
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
    | Display
    |--------------------------------------------------------------------------
    */

    $display = [
        'block'              => 'block',
        'inline-block'       => 'inline-block',
        'inline'             => 'inline',
        'flex'               => 'flex',
        'inline-flex'        => 'inline-flex',
        'table'              => 'table',
        'inline-table'       => 'inline-table',
        'table-caption'      => 'table-caption',
        'table-cell'         => 'table-cell',
        'table-column'       => 'table-column',
        'table-column-group' => 'table-column-group',
        'table-footer-group' => 'table-footer-group',
        'table-header-group' => 'table-header-group',
        'table-row-group'    => 'table-row-group',
        'table-row'          => 'table-row',
        'flow-root'          => 'flow-root',
        'grid'               => 'grid',
        'inline-grid'        => 'inline-grid',
        'contents'           => 'contents',
        'list-item'          => 'list-item',
        'hidden'             => 'none',
    ];

    foreach ($display as $class => $value) {

        $css .= $format(
            ".{$class}",
            [
                "display: {$value};"
            ]
        );
    }


    return $css;
}