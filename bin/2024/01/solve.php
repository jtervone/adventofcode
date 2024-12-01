<?php

require dirname(dirname(dirname(__DIR__))) . "/config.php";

use Adventofcode\Config;
use Adventofcode\Year2024\Day01\Functions;

$filename = Config::$rootPath . "/data/2024/01/data.txt";

list($col1, $col2) = Functions::readData($filename);

$start = microtime(true);
$distance = Functions::calculateDistance($col1, $col2);
$end = microtime(true);

echo "Part 1:\n";
echo "- distance: {$distance}\n";
echo "- time: " . (($end - $start) * 100) . "ms\n\n";

list($col1, $col2) = Functions::readData($filename);
$start = microtime(true);
$similarity = Functions::calculateSimularity($col1, $col2);
$end = microtime(true);

echo "Part 2:\n";
echo "- similarity: {$similarity}\n";
echo "- time: " . (($end - $start) * 100) . "ms\n";
