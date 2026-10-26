<?php
/**
 * Custom Print Utilities
 *
 * Utility khusus media print.
 *
 * Class:
 *
 * print
 * print-block
 * print-inline
 * print-inline-block
 * print-hidden
 * print-visible
 *
 * print-break-before-auto
 * print-break-before
 * print-break-before-avoid
 * print-break-after-auto
 * print-break-after
 * print-break-after-avoid
 * print-break-inside-auto
 * print-break-inside-avoid
 *
 * print-color
 * print-no-color
 *
 * Utility hanya aktif ketika dokumen dicetak.
 */

function reflectorPrint(string $mode = 'beautify'): string
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
                '@',
                '=',
                '*',
                '&',
                '|',
                '^',
                '$',
                '~',
                "'",
                '"',
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
                '\\@',
                '\\=',
                '\\*',
                '\\&',
                '\\|',
                '\\^',
                '\\$',
                '\\~',
                "\\'",
                '\\"',
            ],
            $class
        );
    };


    /*
    |--------------------------------------------------------------------------
    | Generate Print CSS
    |--------------------------------------------------------------------------
    */

    if ($mode === 'minify') {

        $css .= '@media print{';

    } else {

        $css .= "@media print {\n";
    }


    /*
    |--------------------------------------------------------------------------
    | Display
    |--------------------------------------------------------------------------
    */

    $display = [
        'block' => 'block',
        'inline' => 'inline',
        'inline-block' => 'inline-block',
        'flex' => 'flex',
        'inline-flex' => 'inline-flex',
        'grid' => 'grid',
        'inline-grid' => 'inline-grid',
        'table' => 'table',
        'table-row' => 'table-row',
        'table-cell' => 'table-cell',
    ];

    foreach ($display as $classSuffix => $value) {

        $class = "print-{$classSuffix}";

        $selector = '.' . $escapeClass($class);

        $rule = [
            "display: {$value};",
        ];

        $css .= $format(
            $selector,
            $rule
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Hidden
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-hidden',
        [
            'display: none !important;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Visible
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-visible',
        [
            'display: initial !important;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Visibility
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-visible-only',
        [
            'visibility: visible !important;',
        ]
    );

    $css .= $format(
        '.print-invisible',
        [
            'visibility: hidden !important;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Page Break Before
    |--------------------------------------------------------------------------
    */

    $breakBefore = [
        'auto' => 'auto',
        'always' => 'always',
        'avoid' => 'avoid',
        'page' => 'page',
        'left' => 'left',
        'right' => 'right',
    ];

    foreach ($breakBefore as $suffix => $value) {

        $class = "print-break-before-{$suffix}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "break-before: {$value};",
                "page-break-before: {$value};",
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Page Break After
    |--------------------------------------------------------------------------
    */

    $breakAfter = [
        'auto' => 'auto',
        'always' => 'always',
        'avoid' => 'avoid',
        'page' => 'page',
        'left' => 'left',
        'right' => 'right',
    ];

    foreach ($breakAfter as $suffix => $value) {

        $class = "print-break-after-{$suffix}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "break-after: {$value};",
                "page-break-after: {$value};",
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Page Break Inside
    |--------------------------------------------------------------------------
    */

    $breakInside = [
        'auto' => 'auto',
        'avoid' => 'avoid',
        'avoid-page' => 'avoid-page',
    ];

    foreach ($breakInside as $suffix => $value) {

        $class = "print-break-inside-{$suffix}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "break-inside: {$value};",
                "page-break-inside: {$value};",
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Avoid Page Break
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-avoid-break',
        [
            'break-inside: avoid;',
            'page-break-inside: avoid;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Keep Together
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-keep',
        [
            'break-inside: avoid;',
            'page-break-inside: avoid;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Page
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-page',
        [
            'page-break-after: always;',
            'break-after: page;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Page Start
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-page-start',
        [
            'page-break-before: always;',
            'break-before: page;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Page End
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-page-end',
        [
            'page-break-after: always;',
            'break-after: page;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Print Color
    |--------------------------------------------------------------------------
    |
    | Browser dapat menghilangkan background/color saat print.
    | Utility ini meminta browser mempertahankan warna.
    |
    */

    $css .= $format(
        '.print-color',
        [
            '-webkit-print-color-adjust: exact;',
            'print-color-adjust: exact;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Print No Color
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-no-color',
        [
            '-webkit-print-color-adjust: economy;',
            'print-color-adjust: economy;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Print Links
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-no-links::after',
        [
            'content: none !important;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Print Overflow
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-overflow-visible',
        [
            'overflow: visible !important;',
        ]
    );

    $css .= $format(
        '.print-overflow-hidden',
        [
            'overflow: hidden !important;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Print Width
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-full-width',
        [
            'width: 100% !important;',
            'max-width: 100% !important;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Print Background
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-bg-transparent',
        [
            'background: transparent !important;',
            'background-color: transparent !important;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Print Shadow
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-shadow-none',
        [
            'box-shadow: none !important;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Print Border
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-border-none',
        [
            'border: 0 !important;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Print Position
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-static',
        [
            'position: static !important;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Print Float
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-float-none',
        [
            'float: none !important;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Print Text
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-text-left',
        [
            'text-align: left !important;',
        ]
    );

    $css .= $format(
        '.print-text-center',
        [
            'text-align: center !important;',
        ]
    );

    $css .= $format(
        '.print-text-right',
        [
            'text-align: right !important;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Print White Space
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.print-whitespace-normal',
        [
            'white-space: normal !important;',
        ]
    );

    $css .= $format(
        '.print-whitespace-nowrap',
        [
            'white-space: nowrap !important;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Close @media print
    |--------------------------------------------------------------------------
    */

    if ($mode === 'minify') {

        $css .= '}';

    } else {

        $css .= "}\n";
    }


    return $css;
}

?>
