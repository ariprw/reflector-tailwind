<?php
/**
 * Custom Utilities
 *
 * Utility tambahan yang belum tercakup oleh generator utama.
 *
 * Catatan:
 * - Tidak membuat utility sizing, spacing, colors, typography,
 *   flex, grid, position, effects, transform, atau transition.
 * - Responsive akan dibuat otomatis oleh responsive.php.
 */

function reflectorCustom(string $mode = 'beautify'): string
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
    | Cursor
    |--------------------------------------------------------------------------
    */

    $cursor = [
        'auto',
        'default',
        'pointer',
        'wait',
        'text',
        'move',
        'help',
        'not-allowed',
        'none',
        'context-menu',
        'progress',
        'cell',
        'crosshair',
        'vertical-text',
        'alias',
        'copy',
        'no-drop',
        'grab',
        'grabbing',
        'all-scroll',
        'col-resize',
        'row-resize',
        'n-resize',
        'e-resize',
        's-resize',
        'w-resize',
        'ne-resize',
        'nw-resize',
        'se-resize',
        'sw-resize',
        'ew-resize',
        'ns-resize',
        'nesw-resize',
        'nwse-resize',
        'zoom-in',
        'zoom-out',
    ];

    foreach ($cursor as $value) {

        $class = "cursor-{$value}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "cursor: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | User Select
    |--------------------------------------------------------------------------
    */

    $userSelect = [
        'none',
        'text',
        'all',
        'auto',
    ];

    foreach ($userSelect as $value) {

        $class = "select-{$value}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "user-select: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Resize
    |--------------------------------------------------------------------------
    */

    $resize = [
        'none' => 'none',
        'y'    => 'vertical',
        'x'    => 'horizontal',
        ''     => 'both',
    ];

    foreach ($resize as $suffix => $value) {

        $class = $suffix === ''
            ? 'resize'
            : "resize-{$suffix}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "resize: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Appearance
    |--------------------------------------------------------------------------
    */

    $appearance = [
        'none',
        'auto',
    ];

    foreach ($appearance as $value) {

        $class = "appearance-{$value}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "appearance: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Pointer Events
    |--------------------------------------------------------------------------
    */

    $pointerEvents = [
        'none',
        'auto',
    ];

    foreach ($pointerEvents as $value) {

        $class = "pointer-events-{$value}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "pointer-events: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Caret Color
    |--------------------------------------------------------------------------
    |
    | Menggunakan currentColor agar tidak membutuhkan
    | config colors tambahan.
    |
    */

    $css .= $format(
        '.caret-current',
        [
            'caret-color: currentColor;'
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Accent Color
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.accent-current',
        [
            'accent-color: currentColor;'
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Outline
    |--------------------------------------------------------------------------
    */

    $outline = [
        // 'none' => [
        //     'outline: 2px solid transparent;',
        //     'outline-offset: 2px;',
        // ],

        'current' => [
            'outline-color: currentColor;',
        ],

        '0' => [
            'outline-width: 0;',
        ],

        '1' => [
            'outline-width: 1px;',
        ],

        '2' => [
            'outline-width: 2px;',
        ],

        '4' => [
            'outline-width: 4px;',
        ],

        '8' => [
            'outline-width: 8px;',
        ],
    ];

    foreach ($outline as $suffix => $rules) {

        $class = "outline-{$suffix}";

        $css .= $format(
            '.' . $escapeClass($class),
            $rules
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Outline Style
    |--------------------------------------------------------------------------
    */

    $outlineStyles = [
        'solid',
        'dashed',
        'dotted',
        'double',
        // 'none',
    ];

    foreach ($outlineStyles as $value) {

        $class = "outline-{$value}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "outline-style: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Scroll Behavior
    |--------------------------------------------------------------------------
    */

    $scrollBehavior = [
        'auto',
        'smooth',
    ];

    foreach ($scrollBehavior as $value) {

        $class = "scroll-{$value}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "scroll-behavior: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Scroll Snap Type
    |--------------------------------------------------------------------------
    */

    $snapTypes = [
        'none' => 'none',
        'x'    => 'x var(--tw-scroll-snap-strictness, proximity)',
        'y'    => 'y var(--tw-scroll-snap-strictness, proximity)',
        'both' => 'both var(--tw-scroll-snap-strictness, proximity)',
    ];

    foreach ($snapTypes as $suffix => $value) {

        $class = "snap-{$suffix}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "scroll-snap-type: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Scroll Snap Strictness
    |--------------------------------------------------------------------------
    */

    $snapStrictness = [
        'mandatory',
        'proximity',
    ];

    foreach ($snapStrictness as $value) {

        $class = "snap-{$value}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "--tw-scroll-snap-strictness: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Scroll Snap Align
    |--------------------------------------------------------------------------
    */

    $snapAlign = [
        'start',
        'end',
        'center',
        'align-none',
    ];

    foreach ($snapAlign as $value) {

        if ($value === 'align-none') {

            $class = 'snap-none';

            $css .= $format(
                '.' . $escapeClass($class),
                [
                    'scroll-snap-align: none;'
                ]
            );

            continue;
        }

        $class = "snap-{$value}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "scroll-snap-align: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | White Space
    |--------------------------------------------------------------------------
    */

    $whiteSpace = [
        'normal',
        'nowrap',
        'pre',
        'pre-line',
        'pre-wrap',
        'break-spaces',
    ];

    foreach ($whiteSpace as $value) {

        $class = "whitespace-{$value}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "white-space: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Word Break
    |--------------------------------------------------------------------------
    */

    $wordBreak = [
        'normal' => [
            'overflow-wrap: normal;',
            'word-break: normal;',
        ],

        'words' => [
            'overflow-wrap: break-word;',
        ],

        'all' => [
            'word-break: break-all;',
        ],

        'keep' => [
            'word-break: keep-all;',
        ],
    ];

    foreach ($wordBreak as $suffix => $rules) {

        $class = "break-{$suffix}";

        $css .= $format(
            '.' . $escapeClass($class),
            $rules
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Text Overflow
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.truncate',
        [
            'overflow: hidden;',
            'text-overflow: ellipsis;',
            'white-space: nowrap;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Text Ellipsis
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.text-ellipsis',
        [
            'text-overflow: ellipsis;'
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Text Clip
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.text-clip',
        [
            'text-overflow: clip;'
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Screen Reader
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
    | Not Screen Reader
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


    /*
    |--------------------------------------------------------------------------
    | Content Visibility
    |--------------------------------------------------------------------------
    */

    $contentVisibility = [
        'visible',
        'auto',
        'hidden',
    ];

    foreach ($contentVisibility as $value) {

        $class = "content-{$value}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "content-visibility: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Isolation
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.isolate',
        [
            'isolation: isolate;'
        ]
    );

    $css .= $format(
        '.isolation-auto',
        [
            'isolation: auto;'
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Box Decoration Break
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.box-decoration-clone',
        [
            'box-decoration-break: clone;',
            '-webkit-box-decoration-break: clone;',
        ]
    );

    $css .= $format(
        '.box-decoration-slice',
        [
            'box-decoration-break: slice;',
            '-webkit-box-decoration-break: slice;',
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Will Change
    |--------------------------------------------------------------------------
    */

    $willChange = [
        'auto'    => 'auto',
        'scroll'  => 'scroll-position',
        'contents'=> 'contents',
        'transform' => 'transform',
    ];

    foreach ($willChange as $suffix => $value) {

        $class = "will-change-{$suffix}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "will-change: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Object Fit
    |--------------------------------------------------------------------------
    |
    | Ditambahkan di custom karena tidak membutuhkan config.
    |
    */

    $objectFit = [
        'contain',
        'cover',
        'fill',
        'none',
        'scale-down',
    ];

    foreach ($objectFit as $value) {

        $class = "object-{$value}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "object-fit: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Object Position
    |--------------------------------------------------------------------------
    */

    $objectPosition = [
        'bottom',
        'center',
        'left',
        'left-bottom',
        'left-top',
        'right',
        'right-bottom',
        'right-top',
        'top',
    ];

    foreach ($objectPosition as $value) {

        $cssValue = str_replace(
            '-',
            ' ',
            $value
        );

        $class = "object-{$value}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "object-position: {$cssValue};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Visibility
    |--------------------------------------------------------------------------
    |
    | Position generator belum menangani visibility.
    |
    */

    $visibility = [
        'visible',
        'invisible',
        'collapse',
    ];

    foreach ($visibility as $value) {

        $class = $value;

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "visibility: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Hyphens
    |--------------------------------------------------------------------------
    */

    $hyphens = [
        'none',
        'manual',
        'auto',
    ];

    foreach ($hyphens as $value) {

        $class = "hyphens-{$value}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "hyphens: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Writing Mode
    |--------------------------------------------------------------------------
    */

    $writingMode = [
        'horizontal-tb' => 'horizontal-tb',
        'vertical-rl'   => 'vertical-rl',
        'vertical-lr'   => 'vertical-lr',
    ];

    foreach ($writingMode as $suffix => $value) {

        $class = "writing-{$suffix}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "writing-mode: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Direction
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.direction-ltr',
        [
            'direction: ltr;'
        ]
    );

    $css .= $format(
        '.direction-rtl',
        [
            'direction: rtl;'
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Empty Cells
    |--------------------------------------------------------------------------
    */

    $emptyCells = [
        'show',
        'hide',
    ];

    foreach ($emptyCells as $value) {

        $class = "empty-cells-{$value}";

        $css .= $format(
            '.' . $escapeClass($class),
            [
                "empty-cells: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Table Layout
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.table-auto',
        [
            'table-layout: auto;'
        ]
    );

    $css .= $format(
        '.table-fixed',
        [
            'table-layout: fixed;'
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Caption Side
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.caption-top',
        [
            'caption-side: top;'
        ]
    );

    $css .= $format(
        '.caption-bottom',
        [
            'caption-side: bottom;'
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Break Before / After / Inside
    |--------------------------------------------------------------------------
    */

    $breakRules = [
        'before-auto' => [
            'break-before: auto;'
        ],

        'before-avoid' => [
            'break-before: avoid;'
        ],

        'before-all' => [
            'break-before: all;'
        ],

        'before-page' => [
            'break-before: page;'
        ],

        'before-column' => [
            'break-before: column;'
        ],

        'after-auto' => [
            'break-after: auto;'
        ],

        'after-avoid' => [
            'break-after: avoid;'
        ],

        'after-all' => [
            'break-after: all;'
        ],

        'after-page' => [
            'break-after: page;'
        ],

        'after-column' => [
            'break-after: column;'
        ],

        'inside-auto' => [
            'break-inside: auto;'
        ],

        'inside-avoid' => [
            'break-inside: avoid;'
        ],

        'inside-avoid-page' => [
            'break-inside: avoid-page;'
        ],

        'inside-avoid-column' => [
            'break-inside: avoid-column;'
        ],
    ];

    foreach ($breakRules as $class => $rules) {

        $css .= $format(
            '.' . $escapeClass($class),
            $rules
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Return
    |--------------------------------------------------------------------------
    */

    return $css;
}

?>
