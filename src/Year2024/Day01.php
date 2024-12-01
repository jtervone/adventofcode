<?php

namespace Adventofcode\Year2024;

use Adventofcode\Config;

class Day01 {
  public static function solve1stHalf() {
    $filename = Config::$rootPath . "/data/2024/01/data.txt";

    list($col1, $col2) = self::readData($filename);

    $start = microtime(true);
    $distance = self::calculateDistance($col1, $col2);
    $end = microtime(true);

    echo "1st half:\n";
    echo "- distance: {$distance}\n";
    echo "- time: " . (($end - $start) * 100) . "ms\n\n";
  }

  public static function solve2ndHalf() {
    $filename = Config::$rootPath . "/data/2024/01/data.txt";

    list($col1, $col2) = self::readData($filename);

    $start = microtime(true);
    $similarity = self::calculateSimularity($col1, $col2);
    $end = microtime(true);

    echo "2nd half:\n";
    echo "- similarity: {$similarity}\n";
    echo "- time: " . (($end - $start) * 100) . "ms\n";
      }

  /**
   * Get the count of a number in a collection.
   *
   * @param integer $num The number to count.
   * @param array   $col The collection to search.
   *
   * @return integer The count of the number in the collection.
   */
  public static function getCount(int $num, array $col) : int {
    $total = 0;

    foreach ($col as $tmp) {
      if ($num == $tmp) {
        $total++;
      }
    }

    return $total;
  }

  /**
   * Calculate the distance between two collections.
   *
   * @param array $col1 The first collection.
   * @param array $col2 The second collection.
   *
   * @return integer The distance between the two collections.
   */
  public static function calculateDistance(array $col1, array $col2) : int {
    $distance = 0;

    for ($i = 0; $i < count($col1); $i++) {
      $num1 = $col1[$i];
      $num2 = $col2[$i];

      $distance += max($num1, $num2) - min($num1, $num2);
    }

    return $distance;
  }

  /**
   * Calculate the similarity between two collections.
   *
   * @param array $col1 The first collection.
   * @param array $col2 The second collection.
   *
   * @return integer The similarity between the two collections.
   */
  public static function calculateSimularity(array $col1, array $col2) : int {
    $similarity = 0;

    for ($i = 0; $i < count($col1); $i++) {
      $num1 = $col1[$i];

      $count = self::getCount($num1, $col2);

      $similarity += $num1 * $count;
    }

    return $similarity;
  }

  /**
   * Read data from a file.
   *
   * @param string $filename The name of the file to read.
   *
   * @return array The two collections read from the file.
   */
  public static function readData(string $filename) : array {
    $col1 = [];
    $col2 = [];

    $data = file($filename, FILE_IGNORE_NEW_LINES);

    foreach ($data as $row) {
      $tmp = explode("   ", $row);

      $col1[] = $tmp[0];
      $col2[] = $tmp[1];
    }

    sort($col1);
    sort($col2);

    return [ $col1, $col2 ];
  }
}
