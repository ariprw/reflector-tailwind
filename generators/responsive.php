<?php
/**
 * Responsive Generator
 *
 * Membuat responsive variant dari utility CSS yang sudah
 * dihasilkan oleh generator utama.
 *
 * Contoh:
 *
 * p-4
 * =>
 * lg:p-4
 *
 * hover:bg-red-500
 * =>
 * lg:hover:bg-red-500
 *
 * -mt-4
 * =>
 * lg:-mt-4
 *
 * p-1.5
 * =>
 * lg:p-1.5
 *
 * Breakpoint berasal dari:
 *
 * config/breakpoints.php
 *
 * Contoh:
 *
 * return [
 *     // 'sm'  => '640px',
 *     // 'md'  => '768px',
 *     'lg'  => '1024px',
 *     // 'xl'  => '1280px',
 *     // '2xl' => '1536px',
 * ];
 *
 * Responsive menggunakan mobile-first min-width.
 */


/*
|--------------------------------------------------------------------------
| Main Function
|--------------------------------------------------------------------------
*/

function reflectorResponsive(
    array $breakpoints,
    string $baseCSS,
    string $mode = 'beautify'
): string {

    /*
    |--------------------------------------------------------------------------
    | Tidak ada breakpoint
    |--------------------------------------------------------------------------
    */

    if (empty($breakpoints)) {
        return '';
    }


    /*
    |--------------------------------------------------------------------------
    | Tidak ada CSS
    |--------------------------------------------------------------------------
    */

    if (trim($baseCSS) === '') {
        return '';
    }


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
                ' ',
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
                '\\ ',
            ],
            $class
        );
    };


    /*
    |--------------------------------------------------------------------------
    | Remove CSS Comments
    |--------------------------------------------------------------------------
    */

    $baseCSS = preg_replace(
        '/\/\*.*?\*\//s',
        '',
        $baseCSS
    );


    if (!is_string($baseCSS)) {
        return '';
    }


    /*
    |--------------------------------------------------------------------------
    | Extract Top-Level CSS Rules
    |--------------------------------------------------------------------------
    |
    | Kita hanya mengambil:
    |
    | .class { ... }
    |
    | Tidak mengambil:
    |
    | @media
    | @keyframes
    | @font-face
    | @supports
    |
    | Rule yang berada di dalam at-rule juga tidak diproses.
    |
    */

    $extractRules = function (string $css): array {

        $rules = [];

        $length = strlen($css);

        $buffer = '';

        $depth = 0;

        $selector = '';

        $body = '';

        /*
        |--------------------------------------------------------------------------
        | Scan CSS
        |--------------------------------------------------------------------------
        */

        for ($i = 0; $i < $length; $i++) {

            $char = $css[$i];


            /*
            |--------------------------------------------------------------------------
            | Opening brace
            |--------------------------------------------------------------------------
            */

            if ($char === '{') {

                /*
                |--------------------------------------------------------------------------
                | Top-level rule
                |--------------------------------------------------------------------------
                */

                if ($depth === 0) {

                    $selector = trim($buffer);

                    $buffer = '';

                    $depth = 1;

                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | Nested rule
                |--------------------------------------------------------------------------
                */

                $buffer .= $char;

                $depth++;

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Closing brace
            |--------------------------------------------------------------------------
            */

            if ($char === '}') {

                /*
                |--------------------------------------------------------------------------
                | Nested closing brace
                |--------------------------------------------------------------------------
                */

                if ($depth > 1) {

                    $buffer .= $char;

                    $depth--;

                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | Top-level closing brace
                |--------------------------------------------------------------------------
                */

                if ($depth === 1) {

                    $body = trim($buffer);

                    $buffer = '';

                    $depth = 0;


                    /*
                    |--------------------------------------------------------------------------
                    | Validasi selector
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $selector !== ''
                        &&
                        $body !== ''
                        &&
                        str_starts_with($selector, '.')
                        &&
                        !str_starts_with($selector, '@')
                    ) {

                        /*
                        |--------------------------------------------------------------------------
                        | Jangan masukkan selector yang ternyata
                        | mengandung at-rule.
                        |--------------------------------------------------------------------------
                        */

                        if (
                            strpos($selector, '@') === false
                        ) {

                            $rules[] = [
                                'selector' => $selector,
                                'body' => $body,
                            ];
                        }
                    }


                    $selector = '';

                    $body = '';

                    continue;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Normal character
            |--------------------------------------------------------------------------
            */

            $buffer .= $char;
        }


        return $rules;
    };


    /*
    |--------------------------------------------------------------------------
    | Extract Rules
    |--------------------------------------------------------------------------
    */

    $rules = $extractRules($baseCSS);


    /*
    |--------------------------------------------------------------------------
    | Tidak ada utility
    |--------------------------------------------------------------------------
    */

    if (empty($rules)) {
        return '';
    }


    /*
    |--------------------------------------------------------------------------
    | Get First Class Selector
    |--------------------------------------------------------------------------
    |
    | Contoh:
    |
    | .p-4
    | .p-1\.5
    | .hover\:bg-red-500:hover
    | .table-striped tbody tr:hover
    |
    | Hasil:
    |
    | p-4
    | p-1.5
    | hover:bg-red-500
    | table-striped
    |
    */

    $getBaseClass = function (string $selector): ?string {

        if (!str_starts_with($selector, '.')) {
            return null;
        }


        $length = strlen($selector);

        $class = '';

        for ($i = 1; $i < $length; $i++) {

            $char = $selector[$i];


            /*
            |--------------------------------------------------------------------------
            | Escaped character
            |--------------------------------------------------------------------------
            |
            | Contoh:
            |
            | \.
            | \:
            | \/
            |
            */

            if ($char === '\\') {

                $class .= $char;

                if ($i + 1 < $length) {

                    $i++;

                    $class .= $selector[$i];
                }

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Selector delimiter
            |--------------------------------------------------------------------------
            */

            if (
                $char === ':'
                ||
                $char === ','
                ||
                $char === ' '
                ||
                $char === '>'
                ||
                $char === '+'
                ||
                $char === '~'
                ||
                $char === '['
            ) {

                break;
            }


            $class .= $char;
        }


        if ($class === '') {
            return null;
        }


        return $class;
    };


    /*
    |--------------------------------------------------------------------------
    | Unescape CSS Class
    |--------------------------------------------------------------------------
    |
    | CSS selector:
    |
    | p-1\.5
    |
    | menjadi:
    |
    | p-1.5
    |
    */

    $unescapeClass = function (string $class): string {

        return str_replace(
            [
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
                '\\ ',
                '\\\\',
            ],
            [
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
                ' ',
                '\\',
            ],
            $class
        );
    };


    /*
    |--------------------------------------------------------------------------
    | Check Existing Responsive Prefix
    |--------------------------------------------------------------------------
    */

    $hasResponsivePrefix = function (string $class): bool {

        return preg_match(
            '/^(sm|md|lg|xl|2xl):/',
            $class
        ) === 1;
    };


    /*
    |--------------------------------------------------------------------------
    | Generate Responsive
    |--------------------------------------------------------------------------
    */

    $output = '';


    foreach ($breakpoints as $breakpoint => $minWidth) {

        /*
        |--------------------------------------------------------------------------
        | Validate Breakpoint Name
        |--------------------------------------------------------------------------
        */

        if (
            !is_string($breakpoint)
            ||
            $breakpoint === ''
        ) {
            continue;
        }


        /*
        |--------------------------------------------------------------------------
        | Validate Breakpoint Value
        |--------------------------------------------------------------------------
        */

        if (
            !is_string($minWidth)
            &&
            !is_numeric($minWidth)
        ) {
            continue;
        }


        $minWidth = trim((string) $minWidth);


        if ($minWidth === '') {
            continue;
        }


        /*
        |--------------------------------------------------------------------------
        | Media Query
        |--------------------------------------------------------------------------
        */

        if ($mode === 'minify') {

            $output .=
                '@media (min-width:'
                . $minWidth
                . '){';

        } else {

            $output .=
                '@media (min-width: '
                . $minWidth
                . ") {\n";
        }


        /*
        |--------------------------------------------------------------------------
        | Track Generated Selectors
        |--------------------------------------------------------------------------
        |
        | Mencegah duplicate selector.
        |
        */

        $generated = [];


        /*
        |--------------------------------------------------------------------------
        | Process Utility
        |--------------------------------------------------------------------------
        */

        foreach ($rules as $rule) {

            /*
            |--------------------------------------------------------------------------
            | Safety Check
            |--------------------------------------------------------------------------
            */

            if (
                !is_array($rule)
                ||
                !isset($rule['selector'])
                ||
                !isset($rule['body'])
            ) {
                continue;
            }


            $selector = $rule['selector'];

            $body = $rule['body'];


            /*
            |--------------------------------------------------------------------------
            | Pastikan string
            |--------------------------------------------------------------------------
            */

            if (
                !is_string($selector)
                ||
                !is_string($body)
            ) {
                continue;
            }


            $selector = trim($selector);

            $body = trim($body);


            if (
                $selector === ''
                ||
                $body === ''
            ) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Skip Responsive Color Utilities
            |--------------------------------------------------------------------------
            |
            | Responsive variants tetap dibuat untuk layout, spacing, sizing, typography,
            | border width/style, dan utility non-warna lainnya. Utility yang hanya
            | mengubah warna tidak digandakan ke setiap breakpoint. Utility dasar tetap
            | tersedia di luar media query.
            |
            | Pemeriksaan berdasarkan deklarasi, bukan nama class, agar text-sm, bg-cover,
            | border-2, fill-none, dan utility non-warna sejenis tidak ikut terbuang.
            |
            */

            if (preg_match(
                '/(?:^|;)\s*(?:color|background-color|border-(?:top-|right-|bottom-|left-)?color|outline-color|text-decoration-color|text-emphasis-color|caret-color|accent-color|fill|stroke)\s*:/i',
                $body
            )) {
                continue;
            }

            // Opacity/color helper variables are also color-only variants.
            if (preg_match(
                '/--tw-(?:bg|text|border|ring|fill|stroke|decoration|accent|caret|outline|shadow)-[^:;]*(?:color|opacity)/i',
                $body
            )) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Get Base Class
            |--------------------------------------------------------------------------
            */

            $baseClassEscaped = $getBaseClass(
                $selector
            );


            if ($baseClassEscaped === null) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Convert CSS Selector -> HTML Class
            |--------------------------------------------------------------------------
            */

            $baseClass = $unescapeClass(
                $baseClassEscaped
            );


            if ($baseClass === '') {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Skip Existing Responsive
            |--------------------------------------------------------------------------
            */

            if (
                $hasResponsivePrefix(
                    $baseClass
                )
            ) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Skip Print Utilities
            |--------------------------------------------------------------------------
            |
            | print-* hanya berlaku untuk media print.
            | Tidak perlu dibuat:
            |
            | lg:print-hidden
            |
            */

            if (
                $baseClass === 'print'
                ||
                str_starts_with(
                    $baseClass,
                    'print-'
                )
            ) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Responsive Class
            |--------------------------------------------------------------------------
            */

            $responsiveClass =
                $breakpoint
                . ':'
                . $baseClass;


            /*
            |--------------------------------------------------------------------------
            | Responsive Selector
            |--------------------------------------------------------------------------
            */

            $responsiveSelector =
                '.'
                . $escapeClass(
                    $responsiveClass
                );


            /*
            |--------------------------------------------------------------------------
            | Original Selector Suffix
            |--------------------------------------------------------------------------
            |
            | Contoh:
            |
            | .hover\:bg-red-500:hover
            |
            | menjadi:
            |
            | .lg\:hover\:bg-red-500:hover
            |
            | Suffix:
            |
            | :hover
            |
            */

            $originalClassSelector =
                '.'
                . $baseClassEscaped;


            $suffix = '';


            if (
                str_starts_with(
                    $selector,
                    $originalClassSelector
                )
            ) {

                $suffix = substr(
                    $selector,
                    strlen($originalClassSelector)
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Gabungkan Suffix
            |--------------------------------------------------------------------------
            */

            $responsiveSelector .= $suffix;


            /*
            |--------------------------------------------------------------------------
            | Duplicate Protection
            |--------------------------------------------------------------------------
            */

            if (
                isset(
                    $generated[
                        $responsiveSelector
                    ]
                )
            ) {
                continue;
            }


            $generated[
                $responsiveSelector
            ] = true;


            /*
            |--------------------------------------------------------------------------
            | Minify
            |--------------------------------------------------------------------------
            */

            if ($mode === 'minify') {

                $output .=
                    $responsiveSelector
                    . '{'
                    . $body
                    . '}';

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Beautify
            |--------------------------------------------------------------------------
            */

            $output .=
                '    '
                . $responsiveSelector
                . " {\n";


            /*
            |--------------------------------------------------------------------------
            | Split Declarations
            |--------------------------------------------------------------------------
            |
            | Body normal:
            |
            | padding: 1rem;
            | margin: 0;
            |
            */

            $declarations = preg_split(
                '/(?<=;)\s*/',
                $body
            );


            /*
            |--------------------------------------------------------------------------
            | Safety Check
            |--------------------------------------------------------------------------
            */

            if (!is_array($declarations)) {
                $declarations = [
                    $body
                ];
            }


            foreach ($declarations as $declaration) {

                if (!is_string($declaration)) {
                    continue;
                }


                $declaration = trim(
                    $declaration
                );


                if ($declaration === '') {
                    continue;
                }


                $output .=
                    '        '
                    . $declaration
                    . "\n";
            }


            $output .=
                "    }\n";
        }


        /*
        |--------------------------------------------------------------------------
        | Close Media Query
        |--------------------------------------------------------------------------
        */

        if ($mode === 'minify') {

            $output .= '}';

        } else {

            $output .= "}\n";
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Return
    |--------------------------------------------------------------------------
    */

    return $output;
}

?>
