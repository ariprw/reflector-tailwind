<?php
/**
 * Custom Animation Utilities
 *
 * Menyediakan animation utility dan @keyframes.
 *
 * Utility:
 *
 * animate-none
 * animate-spin
 * animate-ping
 * animate-pulse
 * animate-bounce
 *
 * Custom:
 *
 * animate-fade-in
 * animate-fade-out
 * animate-slide-up
 * animate-slide-down
 * animate-slide-left
 * animate-slide-right
 * animate-scale-in
 * animate-scale-out
 */

function reflectorAnimation(string $mode = 'beautify'): string
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

            return $selector
                . '{'
                . implode('', $rules)
                . '}';
        }


        $out = $selector . " {\n";

        foreach ($rules as $rule) {

            $out .= "    {$rule}\n";
        }

        return $out . "}\n";
    };


    /*
    |--------------------------------------------------------------------------
    | Format Keyframes
    |--------------------------------------------------------------------------
    */

    $formatKeyframes = function (
        string $name,
        array $frames
    ) use ($mode): string {

        if ($mode === 'minify') {

            $out = "@keyframes {$name}{";

            foreach ($frames as $frame => $rules) {

                $out .= $frame . '{';

                foreach ($rules as $rule) {
                    $out .= $rule;
                }

                $out .= '}';
            }

            return $out . '}';
        }


        $out = "@keyframes {$name} {\n";

        foreach ($frames as $frame => $rules) {

            $out .= "    {$frame} {\n";

            foreach ($rules as $rule) {

                $out .= "        {$rule}\n";
            }

            $out .= "    }\n";
        }

        return $out . "}\n";
    };


    /*
    |--------------------------------------------------------------------------
    | Animation: none
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.animate-none',
        [
            'animation: none;'
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Spin
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.animate-spin',
        [
            'animation: spin 1s linear infinite;'
        ]
    );


    $css .= $formatKeyframes(
        'spin',
        [
            'from' => [
                'transform: rotate(0deg);'
            ],

            'to' => [
                'transform: rotate(360deg);'
            ],
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Ping
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.animate-ping',
        [
            'animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;'
        ]
    );


    $css .= $formatKeyframes(
        'ping',
        [
            '75%, 100%' => [
                'transform: scale(2);',
                'opacity: 0;',
            ],
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Pulse
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.animate-pulse',
        [
            'animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;'
        ]
    );


    $css .= $formatKeyframes(
        'pulse',
        [
            '0%, 100%' => [
                'opacity: 1;',
            ],

            '50%' => [
                'opacity: 0.5;',
            ],
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Bounce
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.animate-bounce',
        [
            'animation: bounce 1s infinite;'
        ]
    );


    $css .= $formatKeyframes(
        'bounce',
        [
            '0%, 100%' => [
                'transform: translateY(-25%);',
                'animation-timing-function: cubic-bezier(0.8, 0, 1, 1);',
            ],

            '50%' => [
                'transform: none;',
                'animation-timing-function: cubic-bezier(0, 0, 0.2, 1);',
            ],
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Fade In
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.animate-fade-in',
        [
            'animation: fade-in 0.3s ease-out both;'
        ]
    );


    $css .= $formatKeyframes(
        'fade-in',
        [
            'from' => [
                'opacity: 0;',
            ],

            'to' => [
                'opacity: 1;',
            ],
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Fade Out
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.animate-fade-out',
        [
            'animation: fade-out 0.3s ease-in both;'
        ]
    );


    $css .= $formatKeyframes(
        'fade-out',
        [
            'from' => [
                'opacity: 1;',
            ],

            'to' => [
                'opacity: 0;',
            ],
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Slide Up
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.animate-slide-up',
        [
            'animation: slide-up 0.3s ease-out both;'
        ]
    );


    $css .= $formatKeyframes(
        'slide-up',
        [
            'from' => [
                'transform: translateY(1rem);',
                'opacity: 0;',
            ],

            'to' => [
                'transform: translateY(0);',
                'opacity: 1;',
            ],
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Slide Down
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.animate-slide-down',
        [
            'animation: slide-down 0.3s ease-out both;'
        ]
    );


    $css .= $formatKeyframes(
        'slide-down',
        [
            'from' => [
                'transform: translateY(-1rem);',
                'opacity: 0;',
            ],

            'to' => [
                'transform: translateY(0);',
                'opacity: 1;',
            ],
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Slide Left
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.animate-slide-left',
        [
            'animation: slide-left 0.3s ease-out both;'
        ]
    );


    $css .= $formatKeyframes(
        'slide-left',
        [
            'from' => [
                'transform: translateX(1rem);',
                'opacity: 0;',
            ],

            'to' => [
                'transform: translateX(0);',
                'opacity: 1;',
            ],
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Slide Right
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.animate-slide-right',
        [
            'animation: slide-right 0.3s ease-out both;'
        ]
    );


    $css .= $formatKeyframes(
        'slide-right',
        [
            'from' => [
                'transform: translateX(-1rem);',
                'opacity: 0;',
            ],

            'to' => [
                'transform: translateX(0);',
                'opacity: 1;',
            ],
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Scale In
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.animate-scale-in',
        [
            'animation: scale-in 0.2s ease-out both;'
        ]
    );


    $css .= $formatKeyframes(
        'scale-in',
        [
            'from' => [
                'transform: scale(0.95);',
                'opacity: 0;',
            ],

            'to' => [
                'transform: scale(1);',
                'opacity: 1;',
            ],
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Scale Out
    |--------------------------------------------------------------------------
    */

    $css .= $format(
        '.animate-scale-out',
        [
            'animation: scale-out 0.2s ease-in both;'
        ]
    );


    $css .= $formatKeyframes(
        'scale-out',
        [
            'from' => [
                'transform: scale(1);',
                'opacity: 1;',
            ],

            'to' => [
                'transform: scale(0.95);',
                'opacity: 0;',
            ],
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Animation Delay
    |--------------------------------------------------------------------------
    */

    $delays = [
        '0'    => '0ms',
        '75'   => '75ms',
        '100'  => '100ms',
        '150'  => '150ms',
        '200'  => '200ms',
        '300'  => '300ms',
        '500'  => '500ms',
        '700'  => '700ms',
        '1000' => '1000ms',
    ];

    foreach ($delays as $key => $value) {

        $class = "animate-delay-{$key}";

        $css .= $format(
            '.' . $class,
            [
                "animation-delay: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Animation Duration
    |--------------------------------------------------------------------------
    */

    $durations = [
        '75'   => '75ms',
        '100'  => '100ms',
        '150'  => '150ms',
        '200'  => '200ms',
        '300'  => '300ms',
        '500'  => '500ms',
        '700'  => '700ms',
        '1000' => '1000ms',
        '1500' => '1500ms',
        '2000' => '2000ms',
        '3000' => '3000ms',
    ];

    foreach ($durations as $key => $value) {

        $class = "animate-duration-{$key}";

        $css .= $format(
            '.' . $class,
            [
                "animation-duration: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Animation Iteration Count
    |--------------------------------------------------------------------------
    */

    $iterations = [
        'once'     => '1',
        'twice'    => '2',
        'infinite' => 'infinite',
    ];

    foreach ($iterations as $key => $value) {

        $class = "animate-iteration-{$key}";

        $css .= $format(
            '.' . $class,
            [
                "animation-iteration-count: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Animation Direction
    |--------------------------------------------------------------------------
    */

    $directions = [
        'normal',
        'reverse',
        'alternate',
        'alternate-reverse',
    ];

    foreach ($directions as $value) {

        $class = "animate-{$value}";

        $css .= $format(
            '.' . $class,
            [
                "animation-direction: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Animation Fill Mode
    |--------------------------------------------------------------------------
    */

    $fillModes = [
        'none',
        'forwards',
        'backwards',
        'both',
    ];

    foreach ($fillModes as $value) {

        $class = "animate-fill-{$value}";

        $css .= $format(
            '.' . $class,
            [
                "animation-fill-mode: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Animation Play State
    |--------------------------------------------------------------------------
    */

    $playStates = [
        'running',
        'paused',
    ];

    foreach ($playStates as $value) {

        $class = "animate-{$value}";

        $css .= $format(
            '.' . $class,
            [
                "animation-play-state: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Animation Timing Function
    |--------------------------------------------------------------------------
    */

    $timingFunctions = [
        'linear' => 'linear',

        'ease' => 'ease',

        'ease-in' => 'ease-in',

        'ease-out' => 'ease-out',

        'ease-in-out' => 'ease-in-out',
    ];

    foreach ($timingFunctions as $key => $value) {

        $class = "animate-ease-{$key}";

        /*
        |--------------------------------------------------------------------------
        | Hindari animate-ease-ease
        |--------------------------------------------------------------------------
        */

        if ($key === 'ease') {
            $class = 'animate-ease';
        }

        $css .= $format(
            '.' . $class,
            [
                "animation-timing-function: {$value};"
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Reduced Motion
    |--------------------------------------------------------------------------
    |
    | Tidak dibuat sebagai utility biasa.
    | Pengguna yang ingin accessibility dapat memakai:
    |
    | @media (prefers-reduced-motion: reduce)
    |
    | Kita buat secara langsung di sini.
    |
    */

    if ($mode === 'minify') {

        $css .=
            '@media (prefers-reduced-motion: reduce){'
            . '*{'
            . 'animation-duration:0.01ms!important;'
            . 'animation-iteration-count:1!important;'
            . 'transition-duration:0.01ms!important;'
            . 'scroll-behavior:auto!important;'
            . '}'
            . '}';

    } else {

        $css .=
            "@media (prefers-reduced-motion: reduce) {\n"
            . "    * {\n"
            . "        animation-duration: 0.01ms !important;\n"
            . "        animation-iteration-count: 1 !important;\n"
            . "        transition-duration: 0.01ms !important;\n"
            . "        scroll-behavior: auto !important;\n"
            . "    }\n"
            . "}\n";
    }


    return $css;
}

?>
