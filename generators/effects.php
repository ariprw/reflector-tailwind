<?php
/**
 * Generate effects utilities.
 *
 * Opacity:
 * opacity-0
 * opacity-25
 * opacity-50
 * opacity-75
 * opacity-100
 *
 * Box Shadow:
 * shadow
 * shadow-sm
 * shadow-md
 * shadow-lg
 * shadow-xl
 * shadow-2xl
 * shadow-inner
 * shadow-none
 *
 * Outline:
 * outline
 * outline-0
 * outline-1
 * outline-2
 * outline-4
 * outline-8
 * outline-none
 *
 * Ring:
 * ring
 * ring-0
 * ring-1
 * ring-2
 * ring-4
 * ring-8
 * ring-inset
 *
 * Filters:
 * blur
 * blur-none
 * blur-sm
 * blur-md
 * blur-lg
 * blur-xl
 * blur-2xl
 * blur-3xl
 *
 * brightness
 * contrast
 * grayscale
 * hue-rotate
 * invert
 * saturate
 * sepia
 *
 * Drop Shadow:
 * drop-shadow
 * drop-shadow-sm
 * drop-shadow-md
 * drop-shadow-lg
 * drop-shadow-xl
 * drop-shadow-2xl
 * drop-shadow-none
 */

function reflectorEffects(array $spacing, string $mode = 'beautify'): string
{
    $css = '';

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
    | Opacity
    |--------------------------------------------------------------------------
    */

    $opacity = [
        '0'   => '0',
        '5'   => '0.05',
        '10'  => '0.1',
        '15'  => '0.15',
        '20'  => '0.2',
        '25'  => '0.25',
        '30'  => '0.3',
        '35'  => '0.35',
        '40'  => '0.4',
        '45'  => '0.45',
        '50'  => '0.5',
        '55'  => '0.55',
        '60'  => '0.6',
        '65'  => '0.65',
        '70'  => '0.7',
        '75'  => '0.75',
        '80'  => '0.8',
        '85'  => '0.85',
        '90'  => '0.9',
        '95'  => '0.95',
        '100' => '1',
    ];

    foreach ($opacity as $key => $value) {
        $css .= $format(
            ".opacity-{$key}",
            ["opacity: {$value};"]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Box Shadow
    |--------------------------------------------------------------------------
    */

    $shadows = [
        'sm' => '0 1px 2px 0 rgb(0 0 0 / 0.05)',
        ''   => '0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1)',
        'md' => '0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1)',
        'lg' => '0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1)',
        'xl' => '0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1)',
        '2xl' => '0 25px 50px -12px rgb(0 0 0 / 0.25)',
        'inner' => 'inset 0 2px 4px 0 rgb(0 0 0 / 0.05)',
        'none' => '0 0 #0000',
    ];

    foreach ($shadows as $key => $value) {
        $class = $key === '' ? 'shadow' : "shadow-{$key}";

        $css .= $format(
            ".{$class}",
            ["box-shadow: {$value};"]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Outline
    |--------------------------------------------------------------------------
    */

    $outlineWidths = [
        '0' => '0px',
        '1' => '1px',
        '2' => '2px',
        '4' => '4px',
        '8' => '8px',
    ];

    $css .= $format(
        '.outline',
        ['outline-style: solid;']
    );

    foreach ($outlineWidths as $key => $value) {
        $css .= $format(
            ".outline-{$key}",
            [
                "outline-width: {$value};",
                "outline-style: solid;",
            ]
        );
    }

    $css .= $format(
        '.outline-none',
        ['outline: none;']
    );

    /*
    |--------------------------------------------------------------------------
    | Ring
    |--------------------------------------------------------------------------
    */

    $ringWidths = [
        '0' => '0px',
        '1' => '1px',
        '2' => '2px',
        '4' => '4px',
        '8' => '8px',
    ];

    $css .= $format(
        '.ring',
        [
            '--tw-ring-offset-shadow: 0 0 #0000;',
            '--tw-ring-shadow: 0 0 0 3px rgb(59 130 246 / 0.5);',
            'box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);',
        ]
    );

    foreach ($ringWidths as $key => $value) {
        $css .= $format(
            ".ring-{$key}",
            [
                '--tw-ring-offset-shadow: 0 0 #0000;',
                "--tw-ring-shadow: 0 0 0 {$value} rgb(59 130 246 / 0.5);",
                'box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);',
            ]
        );
    }

    $css .= $format(
        '.ring-inset',
        [
            '--tw-ring-inset: inset;',
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | Blur
    |--------------------------------------------------------------------------
    */

    $blur = [
        'none' => 'blur(0)',
        'sm'   => 'blur(4px)',
        ''     => 'blur(8px)',
        'md'   => 'blur(12px)',
        'lg'   => 'blur(16px)',
        'xl'   => 'blur(24px)',
        '2xl'  => 'blur(40px)',
        '3xl'  => 'blur(64px)',
    ];

    foreach ($blur as $key => $value) {
        $class = $key === '' ? 'blur' : "blur-{$key}";

        $css .= $format(
            ".{$class}",
            ["filter: {$value};"]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Brightness
    |--------------------------------------------------------------------------
    */

    $brightness = [
        '0'   => '0',
        '50'  => '.5',
        '75'  => '.75',
        '90'  => '.9',
        '95'  => '.95',
        '100' => '1',
        '105' => '1.05',
        '110' => '1.1',
        '125' => '1.25',
        '150' => '1.5',
        '200' => '2',
    ];

    foreach ($brightness as $key => $value) {
        $css .= $format(
            ".brightness-{$key}",
            ["filter: brightness({$value});"]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Contrast
    |--------------------------------------------------------------------------
    */

    $contrast = [
        '0'   => '0',
        '50'  => '.5',
        '75'  => '.75',
        '100' => '1',
        '125' => '1.25',
        '150' => '1.5',
        '200' => '2',
    ];

    foreach ($contrast as $key => $value) {
        $css .= $format(
            ".contrast-{$key}",
            ["filter: contrast({$value});"]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Grayscale
    |--------------------------------------------------------------------------
    */

    $grayscale = [
        '0'   => '0',
        ''    => '100%',
    ];

    foreach ($grayscale as $key => $value) {
        $class = $key === '' ? 'grayscale' : "grayscale-{$key}";

        $css .= $format(
            ".{$class}",
            ["filter: grayscale({$value});"]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Hue Rotate
    |--------------------------------------------------------------------------
    */

    $hueRotate = [
        '0'   => '0deg',
        '15'  => '15deg',
        '30'  => '30deg',
        '60'  => '60deg',
        '90'  => '90deg',
        '180' => '180deg',
    ];

    foreach ($hueRotate as $key => $value) {
        $css .= $format(
            ".hue-rotate-{$key}",
            ["filter: hue-rotate({$value});"]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Invert
    |--------------------------------------------------------------------------
    */

    $invert = [
        '0' => '0',
        ''  => '100%',
    ];

    foreach ($invert as $key => $value) {
        $class = $key === '' ? 'invert' : "invert-{$key}";

        $css .= $format(
            ".{$class}",
            ["filter: invert({$value});"]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Saturate
    |--------------------------------------------------------------------------
    */

    $saturate = [
        '0'   => '0',
        '50'  => '.5',
        '100' => '1',
        '150' => '1.5',
        '200' => '2',
    ];

    foreach ($saturate as $key => $value) {
        $css .= $format(
            ".saturate-{$key}",
            ["filter: saturate({$value});"]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Sepia
    |--------------------------------------------------------------------------
    */

    $sepia = [
        '0' => '0',
        ''  => '100%',
    ];

    foreach ($sepia as $key => $value) {
        $class = $key === '' ? 'sepia' : "sepia-{$key}";

        $css .= $format(
            ".{$class}",
            ["filter: sepia({$value});"]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Drop Shadow
    |--------------------------------------------------------------------------
    */

    $dropShadows = [
        'sm' => '0 1px 1px rgb(0 0 0 / 0.05)',
        ''   => '0 1px 2px rgb(0 0 0 / 0.1), 0 1px 1px rgb(0 0 0 / 0.06)',
        'md' => '0 4px 3px rgb(0 0 0 / 0.07), 0 2px 2px rgb(0 0 0 / 0.06)',
        'lg' => '0 10px 8px rgb(0 0 0 / 0.04), 0 4px 3px rgb(0 0 0 / 0.1)',
        'xl' => '0 20px 13px rgb(0 0 0 / 0.03), 0 8px 5px rgb(0 0 0 / 0.08)',
        '2xl' => '0 25px 25px rgb(0 0 0 / 0.15)',
        'none' => '0 0 #0000',
    ];

    foreach ($dropShadows as $key => $value) {
        $class = $key === '' ? 'drop-shadow' : "drop-shadow-{$key}";

        $css .= $format(
            ".{$class}",
            ["filter: drop-shadow({$value});"]
        );
    }

    return $css;
}