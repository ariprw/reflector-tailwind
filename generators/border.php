<?php
/**
 * Generate border utilities.
 *
 * Border width:
 * border
 * border-0
 * border-2
 * border-4
 * border-8
 *
 * Border width per side:
 * border-t
 * border-t-0
 * border-t-2
 * border-t-4
 * border-t-8
 *
 * Border style:
 * border-solid
 * border-dashed
 * border-dotted
 * border-double
 * border-hidden
 * border-none
 *
 * Border color:
 * border-red-500
 * border-blue-500
 * border-gray-200
 * border-black
 * border-white
 * border-dark
 * border-inherit
 * border-current
 * border-transparent
 *
 * Border color per side:
 * border-t-red-500
 * border-r-blue-500
 * border-b-gray-200
 * border-l-dark
 *
 * Variants:
 * hover:border-red-500
 * focus:border-red-500
 * hover:border-t-red-500
 * focus:border-t-red-500
 *
 * Border radius:
 * rounded-none
 * rounded
 * rounded-sm
 * rounded-md
 * rounded-lg
 * rounded-xl
 * rounded-2xl
 * rounded-3xl
 * rounded-full
 */

function reflectorBorder(
    array $colors,
    string $mode = 'beautify'
): string {

    $css = '';

    /*
    |--------------------------------------------------------------------------
    | Shared Sides
    |--------------------------------------------------------------------------
    */

    $sides = [
        't' => 'top',
        'r' => 'right',
        'b' => 'bottom',
        'l' => 'left',
    ];

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
    | Variant Helper
    |--------------------------------------------------------------------------
    |
    | Generates:
    | .hover\:border-red-500:hover
    | .focus\:border-red-500:focus
    |
    */

    $variantFormat = function (
        string $class,
        array $rules
    ) use ($format): string {

        $output = '';

        $variants = [
            // 'hover' => ':hover',
            'focus' => ':focus',
        ];

        foreach ($variants as $variant => $pseudo) {

            $selector = '.' . str_replace(
                ':',
                '\\:',
                $variant . ':' . $class
            ) . $pseudo;

            $output .= $format($selector, $rules);
        }

        return $output;
    };

    /*
    |--------------------------------------------------------------------------
    | Border Width
    |--------------------------------------------------------------------------
    */

    $widths = [
        '0' => '0px',
        ''  => '1px',
        '2' => '2px',
        '4' => '4px',
        '8' => '8px',
    ];

    foreach ($widths as $key => $value) {

        // All sides

        $class = $key === ''
            ? 'border'
            : "border-{$key}";

        $css .= $format(
            ".{$class}",
            [
                "border-width: {$value};",
            ]
        );

        // Individual sides

        foreach ($sides as $prefix => $side) {

            $class = $key === ''
                ? "border-{$prefix}"
                : "border-{$prefix}-{$key}";

            $css .= $format(
                ".{$class}",
                [
                    "border-{$side}-width: {$value};",
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Border Style
    |--------------------------------------------------------------------------
    */

    $styles = [
        'solid',
        'dashed',
        'dotted',
        'double',
        'hidden',
        'none',
    ];

    foreach ($styles as $style) {

        // All sides

        $css .= $format(
            ".border-{$style}",
            [
                "border-style: {$style};",
            ]
        );

        // Individual sides

        foreach ($sides as $prefix => $side) {

            $css .= $format(
                ".border-{$prefix}-{$style}",
                [
                    "border-{$side}-style: {$style};",
                ]
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Normalize Colors
    |--------------------------------------------------------------------------
    |
    | Supports flat colors:
    | black, white, inherit, current, transparent
    |
    | Supports nested palettes:
    | red-50, red-100, red-500, red-950
    |
    | Supports DEFAULT colors:
    | dark.DEFAULT -> dark
    |
    */

    $flattenColors = [];

    foreach ($colors as $name => $value) {

        // Single colors

        if (is_string($value)) {
            $flattenColors[$name] = $value;
            continue;
        }

        // Nested palettes

        if (!is_array($value)) {
            continue;
        }

        foreach ($value as $shade => $hex) {

            if (!is_string($hex)) {
                continue;
            }

            $colorName = strtoupper((string) $shade) === 'DEFAULT'
                ? $name
                : "{$name}-{$shade}";

            $flattenColors[$colorName] = $hex;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Border Color
    |--------------------------------------------------------------------------
    |
    | Generates:
    | border-red-500
    | hover:border-red-500
    | focus:border-red-500
    | border-t-red-500
    | hover:border-t-red-500
    | focus:border-t-red-500
    |
    | CSS variables must follow the naming convention:
    | --red-500
    | --black
    | --dark
    |
    */

    foreach ($flattenColors as $key => $hex) {

        // All sides

        $rules = [
            "border-color: {$hex};",
        ];

        $css .= $format(
            ".border-{$key}",
            $rules
        );
        
        // Generate hover only for current
        if ($key === 'current') {
            $css .= $format(
                '.hover\\:border-current:hover',
                $rules
            );
        }

        $css .= $variantFormat(
            "border-{$key}",
            $rules
        );

        // Individual sides

        foreach ($sides as $prefix => $side) {

            $sideRules = [
                "border-{$side}-color: {$hex};",
            ];

            $class = "border-{$prefix}-{$key}";

            $css .= $format(
                ".{$class}",
                $sideRules
            );

            $css .= $variantFormat(
                $class,
                $sideRules
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Border Radius
    |--------------------------------------------------------------------------
    |
    | All corners:
    | rounded-none
    | rounded
    | rounded-sm
    | rounded-md
    | rounded-lg
    | rounded-xl
    | rounded-2xl
    | rounded-3xl
    | rounded-full
    |
    | Individual sides:
    | rounded-t-none
    | rounded-r-none
    | rounded-b-none
    | rounded-l-none
    |
    | Individual side radius:
    | rounded-t-lg
    | rounded-r-md
    | rounded-b-xl
    | rounded-l-full
    |
    */

    $radius = [
        'none' => '0px',
        ''     => '0.25rem',
        'sm'   => '0.125rem',
        'md'   => '0.375rem',
        'lg'   => '0.5rem',
        'xl'   => '0.75rem',
        '2xl'  => '1rem',
        '3xl'  => '1.5rem',
        'full' => '9999px',
    ];

    /*
    |--------------------------------------------------------------------------
    | All Corners
    |--------------------------------------------------------------------------
    */

    foreach ($radius as $key => $value) {

        $class = $key === ''
            ? 'rounded'
            : "rounded-{$key}";

        $css .= $format(
            ".{$class}",
            [
                "border-radius: {$value};",
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Individual Sides
    |--------------------------------------------------------------------------
    |
    | t = top
    | r = right
    | b = bottom
    | l = left
    |
    */

    $radiusSides = [
        't' => [
            'border-top-left-radius',
            'border-top-right-radius',
        ],
        'r' => [
            'border-top-right-radius',
            'border-bottom-right-radius',
        ],
        'b' => [
            'border-bottom-right-radius',
            'border-bottom-left-radius',
        ],
        'l' => [
            'border-top-left-radius',
            'border-bottom-left-radius',
        ],
    ];

    foreach ($radiusSides as $prefix => $properties) {

        foreach ($radius as $key => $value) {

            $class = $key === ''
                ? "rounded-{$prefix}"
                : "rounded-{$prefix}-{$key}";

            $rules = [];

            foreach ($properties as $property) {
                $rules[] = "{$property}: {$value};";
            }

            $css .= $format(
                ".{$class}",
                $rules
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Return
    |--------------------------------------------------------------------------
    */

    return $css;
}