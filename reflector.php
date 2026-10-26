<?php
require_once __DIR__ . '/src/minifier.php';

$mode = 'beautify';

$generated = require __DIR__ . '/src/generator.php';

$beautifyPath = __DIR__ . '/output/beautify/tailwind.css';
$minifyPath   = __DIR__ . '/output/minify/tailwind.css';

function formatBytesCLI(int $bytes): string
{
    if ($bytes >= 1024 * 1024) {
        return number_format($bytes / 1024 / 1024, 2) . ' MB';
    }

    if ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    }

    return $bytes . ' B';
}

/*
|--------------------------------------------------------------------------
| Generate Beautify
|--------------------------------------------------------------------------
*/

$beautifyCSS = $generated;

/*
|--------------------------------------------------------------------------
| Generate Minify
|--------------------------------------------------------------------------
*/

$minifyCSS = minifyCSS($generated);

/*
|--------------------------------------------------------------------------
| Write Files
|--------------------------------------------------------------------------
*/

file_put_contents(
    $beautifyPath,
    $beautifyCSS
);

file_put_contents(
    $minifyPath,
    $minifyCSS
);

/*
|--------------------------------------------------------------------------
| File Size
|--------------------------------------------------------------------------
*/

$beautifySize = filesize($beautifyPath);
$minifySize   = filesize($minifyPath);

/*
|--------------------------------------------------------------------------
| Output
|--------------------------------------------------------------------------
*/

echo PHP_EOL;
echo "Reflector Tailwind generated." . PHP_EOL;
echo PHP_EOL;

echo "Beautify : {$beautifyPath}" . PHP_EOL;
echo "           " . formatBytesCLI($beautifySize) . PHP_EOL;
echo PHP_EOL;

echo "Minify   : {$minifyPath}" . PHP_EOL;
echo "           " . formatBytesCLI($minifySize) . PHP_EOL;
echo PHP_EOL;
?>
