<?php
/**
 * Custom Pagination Utilities
 *
 * Utility untuk pagination sederhana.
 *
 * Class:
 *
 * pagination
 * page-list
 * page-item
 * page-link
 * page-link-active
 * page-link-disabled
 * page-prev
 * page-next
 * page-first
 * page-last
 * page-ellipsis
 *
 * Tidak menggunakan warna/theme agar tetap ringan.
 * Styling warna dapat ditambahkan menggunakan utility
 * colors yang sudah tersedia.
 */

function reflectorPagination(string $mode = 'beautify'): string
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
    | Pagination Container
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.pagination',
        [
            'display: flex;',
            'align-items: center;',
            'user-select: none;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Pagination List
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.page-list',
        [
            'display: flex;',
            'align-items: center;',
            'list-style: none;',
            'margin: 0;',
            'padding: 0;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Pagination Item
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.page-item',
        [
            'display: flex;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Pagination Link
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.page-link',
        [
            'text-decoration: none;',
            'cursor: pointer;',
            'font-size: 13px;',
            'padding: 4px 12px;',
            'color: #4d7c0f;',
            'background: #ffffff;',
            'border-radius: 18px;',
        ]
    );

    $css .= $format(
        '.page-link:hover',
        [
            'color: #ffffff;',
            'background: #4d7c0f;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Pagination Active
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.active .page-link',
        [
            'background: #4d7c0f;',
            'color: #ffffff;',
            'cursor: not-allowed;',
        ]
    );

    $css .= $format(
        '.page-link-active',
        [
            'cursor: default;',
            'pointer-events: none;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Pagination Disabled
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.disabled .page-link',
        [
            'cursor: not-allowed;',
        ]
    );

    $css .= $format(
        '.page-link-disabled',
        [
            'cursor: not-allowed;',
            'pointer-events: none;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Previous
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.page-prev',
        [
            'display: inline-flex;',
            'align-items: center;',
            'justify-content: center;',
            'text-decoration: none;',
            'cursor: pointer;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Next
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.page-next',
        [
            'display: inline-flex;',
            'align-items: center;',
            'justify-content: center;',
            'text-decoration: none;',
            'cursor: pointer;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | First
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.page-first',
        [
            'display: inline-flex;',
            'align-items: center;',
            'justify-content: center;',
            'text-decoration: none;',
            'cursor: pointer;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Last
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.page-last',
        [
            'display: inline-flex;',
            'align-items: center;',
            'justify-content: center;',
            'text-decoration: none;',
            'cursor: pointer;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Ellipsis
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.page-ellipsis',
        [
            'display: inline-flex;',
            'align-items: center;',
            'justify-content: center;',
            'user-select: none;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Pagination Gap
    |--------------------------------------------------------------------------
    |
    | Memberikan jarak antar item tanpa menentukan ukuran
    | visual pagination.
    |
    */

    $css .= $format(
        '.page-list-gap',
        [
            'gap: 0.25rem;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Pagination Horizontal
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.page-horizontal',
        [
            'flex-direction: row;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Pagination Vertical
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.page-vertical',
        [
            'flex-direction: column;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Pagination Full Width
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.page-full',
        [
            'width: 100%;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Pagination Start
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.page-start',
        [
            'justify-content: flex-start;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Pagination End
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.page-end',
        [
            'justify-content: flex-end;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Pagination Center
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.page-center',
        [
            'justify-content: center;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Pagination Link Block
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.page-link-block',
        [
            'display: flex;',
            'width: 100%;',
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
