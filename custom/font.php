<?php
/**
* Font
* 
* Support:
* - beautify
* - minify
*/

function reflectorFont(
    string $mode = 'beautify'
): string {
    $rules = [
        [
            'selector' => '@font-face',
            'declarations' => [
                'font-family: "Google Sans Flex";',
                'src: url("/fonts/GoogleSansFlex-VariableFont.ttf") format("truetype");',
                'font-weight: 100 1000;',
                'font-style: normal;',
                'font-display: swap;',
            ],
        ],
        [
            'selector' => '.font-google-sans-flex *',
            'declarations' => [
                'font-family: "Google Sans Flex", sans-serif;'
            ],
        ],
    ];
    $css = "";
    foreach ($rules as $rule) {
        $selector = $rule["selector"];
        $declarations = $rule["declarations"];
        if ($mode === "minify") {
            $css .= $selector . "{";
            $css .= implode("", $declarations);
            $css .= "}";
            continue;
        }
        $css .= $selector . " {\n";
        foreach ($declarations as $declaration) {
            $css .= " {$declaration}\n";
        }
        $css .= "}\n";
    }
    return $css;
} ?>
