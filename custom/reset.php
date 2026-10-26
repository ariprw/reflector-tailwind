<?php
/**
* CSS Reset
*
* Basic reset untuk menghilangkan default browser style.
*
* Support:
* - beautify
* - minify
*/

function reflectorReset(
    string $mode = "beautify"
): string {
    $rules = [
        [
            "selector" => "*, *::before, *::after",
            "declarations" => [
                "box-sizing: border-box;"
            ],
        ],
        [
            "selector" => "*",
            "declarations" => [
                "margin: 0;",
                "padding: 0;",
                "font-family: Arial, sans-serif;",
            ]
        ],
        [
            "selector" => "html",
            "declarations" => [
                "line-height: 1.5;",
                "word-break: break-word;",
            ],
        ],
        [
            "selector" => "button, input, optgroup, select, textarea",
            "declarations" => [
                "font: inherit;",
                "line-height: inherit;",
                "color: inherit;",
            ],
        ],
        [
            "selector" => "button, select",
            "declarations" => [
                "text-transform: none;"
            ],
        ],
        [
            "selector" =>
                'button, [type="button"], [type="reset"], [type="submit"]',
            "declarations" => [
                "-webkit-appearance: button;",
                "background-color: transparent;",
                "background-image: none;",
            ],
        ],
        [
            "selector" =>
                "img, svg, video, canvas, audio, iframe, embed, object",
            "declarations" => [
                "display: block;",
                "vertical-align: middle;"
            ],
        ],
        [
            "selector" => "img, video",
            "declarations" => [
                "max-width: 100%;",
                "height: auto;"
            ],
        ],
        [
            "selector" => "a",
            "declarations" => [
                "color: inherit;",
                "text-decoration: inherit;"
            ],
        ],
        [
            "selector" => 'button, [role="button"]',
            "declarations" => [
                "cursor: pointer;"
            ],
        ],
        [
            "selector" => "ol, ul",
            "declarations" => [
                "list-style: none;"
            ]
        ],
        [
            "selector" => "table",
            "declarations" => [
                "border-collapse: collapse;",
                "border-spacing: 0;",
                "word-break: normal;"
            ],
        ],
        [
            "selector" => "hr",
            "declarations" => [
                "height: 0;",
                "color: inherit;",
                "border-top-width: 1px;",
            ],
        ],
        [
            "selector" => "abbr:where([title])",
            "declarations" => [
                "text-decoration: underline dotted;"
            ],
        ],
        [
            "selector" => "b, strong",
            "declarations" => [
                "font-weight: bolder;"
            ]
        ],
        [
            "selector" => "code, kbd, samp, pre",
            "declarations" => [
                "font-family: monospace;",
                "font-size: 1em;"
            ],
        ],
        [
            "selector" => "small",
            "declarations" => [
                "font-size: 80%;"
            ]
        ],
        [
            "selector" => "sub, sup",
            "declarations" => [
                "font-size: 75%;",
                "line-height: 0;",
                "position: relative;",
                "vertical-align: baseline;",
            ],
        ],
        [
            "selector" => "sub",
            "declarations" => [
                "bottom: -0.25em;"
            ]
        ],
        [
            "selector" => "sup",
            "declarations" => [
                "top: -0.5em;"
            ]
        ],
        [
            "selector" => "textarea",
            "declarations" => [
                "resize: vertical;"
            ]
        ],
        [
            "selector" => "::-webkit-file-upload-button",
            "declarations" => [
                "-webkit-appearance: button;",
                "font: inherit;"
            ],
        ],
        [
            "selector" => "::placeholder",
            "declarations" => [
                "opacity: 1;",
                "color: #9ca3af;"
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
