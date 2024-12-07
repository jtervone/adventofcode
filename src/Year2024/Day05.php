<?php

namespace Adventofcode\Year2024;

use Adventofcode\Config;

class Day05 {
  /**
   * Solve the first half of the day's puzzle.
   *
   * @return void
   */
  public static function solve1stHalf() : void {
    $filename = Config::$rootPath . "/data/2024/input-05.txt";

    $start = microtime(true);

    $result = self::solve1($filename);

    $end = microtime(true);

    echo "1st half:\n";
    echo "- result: {$result}\n";
    echo "- time: " . (($end - $start) * 100) . "ms\n\n";
  }

  /**
   * Solve the first half of the day's puzzle.
   *
   * @param string $filename The name of the file to read.
   *
   * @return integer The sum of the middle pages of the updates that are in order.
   */
  public static function solve1(string $filename) : int {
    [ $rules, $updates ] = self::parseInput($filename);
    $sum = 0;

    foreach ($updates as $update) {
      if (self::isUpdateInOrder($update, $rules)) {
        $sum += self::findMiddlePage($update);
      }
    }

    return $sum;
  }

  /**
   * Parse the input file.
   *
   * @param string $filename The name of the file to read.
   *
   * @return array The two collections read from the file.
   */
  public static function parseInput(string $filename) : array {
    $input = file_get_contents($filename);

    $sections = explode("\n\n", trim($input));
    $rules = array_map(fn($line) => explode("|", $line), explode("\n", $sections[0]));
    $updates = array_map(fn($line) => explode(",", $line), explode("\n", $sections[1]));

    return [ $rules, $updates ];
  }

  /**
   * Check if the update is in order.
   *
   * @param array $update The update to check.
   * @param array $rules  The rules to check against.
   *
   * @return boolean True if the update is in order, false otherwise.
   */
  public static function isUpdateInOrder(array $update, array $rules) : bool {
    // Map each page number to its index in the update
    $position = array_flip($update);

    foreach ($rules as [ $before, $after ]) {
      if (isset($position[$before]) && isset($position[$after])) {
        // Check if the "before" page comes before the "after" page
        if ($position[$before] > $position[$after]) {
          return false;
        }
      }
    }

    return true;
  }

  /**
   * Find the middle page of the update.
   *
   * @param array $update The update to check.
   *
   * @return integer The middle page of the update.
   */
  public static function findMiddlePage(array $update) : int {
    $middleIndex = floor(count($update) / 2);

    return $update[$middleIndex];
  }

  /**
   * Solve the second half of the day's puzzle.
   *
   * @return void
   */
  public static function solve2ndHalf() : void {
    $filename = Config::$rootPath . "/data/2024/input-05.txt";

    $start = microtime(true);

    $result = self::solve2($filename);

    $end = microtime(true);

    echo "2nd half:\n";
    echo "- result: {$result}\n";
    echo "- time: " . (($end - $start) * 100) . "ms\n\n";
  }

  /**
   * Solve the second half of the day's puzzle.
   *
   * @param string $filename The name of the file to read.
   *
   * @return integer The sum of the middle pages of the updates that are not in order.
   */
  public static function solve2(string $filename) : int {
    $count = 0;

    [ $rules, $updates ] = self::parseInput($filename);

    foreach ($updates as $update) {
      if (!self::isUpdateInOrder($update, $rules)) {
          $sortedUpdate = self::sortUpdateByRules($update, $rules);
          $count += self::findMiddlePage($sortedUpdate);
      }
    }

    return $count;
  }

  /**
   * Sort the update based on the rules.
   *
   * @param array $update The update to sort.
   * @param array $rules  The rules to sort the update by.
   *
   * @return array The sorted update.
   */
  public static function sortUpdateByRules(array $update, array $rules) : array {
    // Build a dependency graph
    $graph = [];
    foreach ($rules as [$before, $after]) {
      if (in_array($before, $update) && in_array($after, $update)) {
        $graph[$before][] = $after;
      }
    }

    // Perform topological sort
    $visited = [];
    $sorted = [];
    $temp = [];

    $visit = function ($node) use (&$visit, &$visited, &$sorted, &$temp, $graph) {
      if (!isset($visited[$node])) {
        $temp[$node] = true;

        foreach ($graph[$node] ?? [] as $neighbor) {
          $visit($neighbor);
        }

        $visited[$node] = true;
        $sorted[] = $node;

        unset($temp[$node]);
      }
    };

    foreach ($update as $node) {
      if (!isset($visited[$node])) {
        $visit($node);
      }
    }

    // Return the sorted update based on the topological sort order
    $sorted = array_reverse($sorted); // Reverse the order as per dependency

    return $sorted;
  }


  /**
   * Read data from a file.
   *
   * @param string $filename The name of the file to read.
   *
   * @return array The two collections read from the file.
   */
  public static function readData(string $filename) : array {
    $output = [];
    $data = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    for ($y = 0; $y < count($data); $y++) {
      $output[$y] = str_split($data[$y]);
    }

    return $output;
  }
}
