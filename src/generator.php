<?php
$mode = $mode ?? 'beautify';

$spacing = require __DIR__ . '/../config/spacing.php';
$colors  = require __DIR__ . '/../config/colors.php';
$typography  = require __DIR__ . '/../config/typography.php';
$flex  = require __DIR__ . '/../config/flex.php';
$grid  = require __DIR__ . '/../config/grid.php';
$breakpoints = require __DIR__ . '/../config/breakpoints.php';


require_once __DIR__ . '/../custom/reset.php';
require_once __DIR__ . '/../custom/custom.php';
require_once __DIR__ . '/../custom/animation.php';
require_once __DIR__ . '/../custom/pagination.php';
require_once __DIR__ . '/../custom/table.php';
require_once __DIR__ . '/../custom/print.php';
require_once __DIR__ . '/../custom/font.php';


require_once __DIR__ . '/../generators/sizing.php';
require_once __DIR__ . '/../generators/spacing.php';
require_once __DIR__ . '/../generators/colors.php';
require_once __DIR__ . '/../generators/border.php';
require_once __DIR__ . '/../generators/typography.php';
require_once __DIR__ . '/../generators/display.php';
require_once __DIR__ . '/../generators/flex.php';
require_once __DIR__ . '/../generators/grid.php';
require_once __DIR__ . '/../generators/overflow.php';
require_once __DIR__ . '/../generators/position.php';
require_once __DIR__ . '/../generators/effects.php';
require_once __DIR__ . '/../generators/transform.php';
require_once __DIR__ . '/../generators/transition.php';
require_once __DIR__ . '/../generators/responsive.php';



$css = '';

$css .= reflectorReset($mode);
$css .= reflectorSizing($spacing, $mode);
$css .= reflectorSpacing($spacing, $mode);
$css .= reflectorColors($colors, $mode);
$css .= reflectorBorder($colors, $mode);
$css .= reflectorTypography($typography, $mode);
$css .= reflectorDisplay($mode);
$css .= reflectorFlex($flex, $mode);
$css .= reflectorGrid($grid, $mode);
$css .= reflectorPosition($spacing, $mode);
$css .= reflectorEffects($colors, $mode);
$css .= reflectorTransform($spacing, $mode);
$css .= reflectorTransition($mode);
$css .= reflectorCustom($mode);
$css .= reflectorAnimation($mode);
$css .= reflectorPagination($mode);
$css .= reflectorTable($mode);
$css .= reflectorOverflow($mode);
$css .= reflectorFont($mode);

$css .= reflectorPrint($mode);

$css .= reflectorResponsive(
    $breakpoints,
    $css,
    $mode
);


return $css;
