#!/usr/bin/env php
<?php

require_once dirname(__DIR__) . "/config.php";

use Adventofcode\Config;

$year = $argv[1];
$day = $argv[2];

$filename = Config::$rootPath . "/src/Year{$year}/Day{$day}.php";

if (!file_exists($filename)) {
  echo "Class not found for {$year}/{$day}\n";
  exit(1);
}

require_once $filename;

$className = "Adventofcode\\Year{$year}\\Day{$day}";

if (method_exists($className, "solve1stHalf")) {
  $className::solve1stHalf();
}

if (method_exists($className, "solve2ndHalf")) {
  $className::solve2ndHalf();
}
