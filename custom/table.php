<?php
/**
 * Custom Table Utilities
 *
 * Utility khusus tabel.
 *
 * Class:
 *
 * table-auto
 * table-fixed
 *
 * border-collapse
 * border-separate
 *
 * caption-top
 * caption-bottom
 *
 * table-responsive
 * table-responsive-x
 * table-responsive-y
 *
 * table-layout-auto
 * table-layout-fixed
 *
 * table-header
 * table-body
 * table-footer
 *
 * table-row
 * table-cell
 * table-cell-middle
 * table-cell-top
 * table-cell-bottom
 *
 * table-nowrap
 * table-wrap
 *
 * table-hover
 * table-striped
 *
 * Tidak mengatur warna, padding, border, atau typography
 * agar tetap kompatibel dengan generator utama.
 */

function reflectorTable(string $mode = 'beautify'): string
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
    | Table Layout
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-layout-auto',
        [
            'table-layout: auto;',
        ]
    );

    $css .= $format(
        '.table-layout-fixed',
        [
            'table-layout: fixed;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Border Collapse
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.border-collapse',
        [
            'border-collapse: collapse;',
        ]
    );

    $css .= $format(
        '.border-separate',
        [
            'border-collapse: separate;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Border Spacing
    |--------------------------------------------------------------------------
    |
    | Menggunakan nilai CSS langsung supaya tidak membutuhkan
    | config spacing tambahan.
    |
    */

    $borderSpacing = [
        '0' => '0',
        '1' => '1px',
        '2' => '2px',
        '4' => '4px',
        '8' => '8px',
    ];

    foreach ($borderSpacing as $key => $value) {

        $class = "border-spacing-{$key}";

        $css .= $format(
            '.' . $class,
            [
                "border-spacing: {$value};",
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Caption
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.caption-top',
        [
            'caption-side: top;',
        ]
    );

    $css .= $format(
        '.caption-bottom',
        [
            'caption-side: bottom;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Table Responsive
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-responsive',
        [
            'width: 100%;',
            'overflow-x: auto;',
            'overflow-y: hidden;',
            '-webkit-overflow-scrolling: touch;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Horizontal Responsive
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-responsive-x',
        [
            'width: 100%;',
            'overflow-x: auto;',
            'overflow-y: hidden;',
            '-webkit-overflow-scrolling: touch;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Vertical Responsive
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-responsive-y',
        [
            'max-height: 100%;',
            'overflow-x: hidden;',
            'overflow-y: auto;',
            '-webkit-overflow-scrolling: touch;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Table Header
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-header',
        [
            'display: table-header-group;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Table Body
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-body',
        [
            'display: table-row-group;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Table Footer
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-footer',
        [
            'display: table-footer-group;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Table Row
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-row',
        [
            'display: table-row;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Table Cell
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-cell',
        [
            'display: table-cell;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Vertical Align
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-cell-top',
        [
            'vertical-align: top;',
        ]
    );

    $css .= $format(
        '.table-cell-middle',
        [
            'vertical-align: middle;',
        ]
    );

    $css .= $format(
        '.table-cell-bottom',
        [
            'vertical-align: bottom;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Table Width
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-full',
        [
            'width: 100%;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Table Minimum Width
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-min-full',
        [
            'min-width: 100%;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Table White Space
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-nowrap',
        [
            'white-space: nowrap;',
        ]
    );

    $css .= $format(
        '.table-wrap',
        [
            'white-space: normal;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Table Striped
    |--------------------------------------------------------------------------
    |
    | Hanya struktur selector.
    | Warna tetap mengikuti CSS/theme milik pengguna.
    |
    */

    $css .= $format(
        '.table-striped tbody tr:nth-child(even)',
        [
            'background-color: rgba(0, 0, 0, 0.025);',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Table Hover
    |--------------------------------------------------------------------------
    |
    | Hover sangat ringan dan tidak menentukan warna brand.
    |
    */

    $css .= $format(
        '.table-hover tbody tr:hover',
        [
            'background-color: rgba(0, 0, 0, 0.05);',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Table Borderless
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-borderless',
        [
            'border-collapse: collapse;',
        ]
    );

    $css .= $format(
        '.table-borderless th',
        [
            'border-width: 0;',
        ]
    );

    $css .= $format(
        '.table-borderless td',
        [
            'border-width: 0;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Table Compact
    |--------------------------------------------------------------------------
    |
    | Tidak mengatur padding.
    | Hanya mengontrol line-height agar tabel lebih compact.
    |
    */

    $css .= $format(
        '.table-compact',
        [
            'line-height: 1.25;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Table Spacious
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-spacious',
        [
            'line-height: 1.75;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Table Fixed Columns
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-fixed-columns',
        [
            'table-layout: fixed;',
            'width: 100%;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Table Overflow
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-overflow-auto',
        [
            'overflow: auto;',
        ]
    );

    $css .= $format(
        '.table-overflow-hidden',
        [
            'overflow: hidden;',
        ]
    );

    $css .= $format(
        '.table-overflow-visible',
        [
            'overflow: visible;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Return
    |--------------------------------------------------------------------------
    */

    return $css;
}

?>
