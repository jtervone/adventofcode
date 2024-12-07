<?php

namespace Adventofcode\Year2024;

use Adventofcode\Config;

class Day07 {
  /**
   * Solve the first half of the day's puzzle.
   *
   * @return void
   */
  public static function solve1stHalf() : void {
    $filename = Config::$rootPath . "/data/2024/input-07.txt";

    $start = microtime(true);

    $data = self::readData($filename);
    $equations = self::calculateEquation($data, [ "+", "*" ]);

    $end = microtime(true);

    echo "1st half:\n";
    echo "- result: {$equations}\n";
    echo "- time: " . (($end - $start) * 100) . "ms\n\n";
  }

  /**
   * Solve the second half of the day's puzzle.
   *
   * @return void
   */
  public static function solve2ndHalf() : void {
    $filename = Config::$rootPath . "/data/2024/input-07.txt";

    $start = microtime(true);

    $data = self::readData($filename);
    $equations = self::calculateEquation($data, [ "+", "*", "||" ]);

    $end = microtime(true);

    echo "2nd half:\n";
    echo "- result: {$equations}\n";
    echo "- time: " . (($end - $start) * 100) . "ms\n\n";
  }

  /**
   * Calculate the equations.
   *
   * @param array $data      The data to calculate.
   * @param array $operators The operators to use.
   *
   * @return integer The number of equations.
   */
  public static function calculateEquation(array $data, array $operators) : int {
    $equations = 0;

    foreach ($data as $row) {
      [ $result, $numbers ] = self::parseRow($row);
      $equation = self::solveRow($result, $numbers, $operators) ?? 0;
      $equations += $equation;
    }

    return $equations;
  }

  /**
   * Solve a row.
   *
   * @param integer $result    The result to solve for.
   * @param array   $numbers   The numbers to use.
   * @param array   $operators The operators to use.
   *
   * @return integer|false The result of the equation or false if it can't be solved.
   */
  public static function solveRow(int $result, array $numbers, array $operators) : int | bool {
    $equations = 0;
    $operatorCount = count($numbers) - 1;
    $permutations = self::getPermutations($operatorCount, $operators);

    foreach ($permutations as $permutation) {
      $total = $numbers[0];
      for ($i = 0; $i < $operatorCount; $i++) {
        if ($permutation[$i] === "||") {
          $total = $total . "" . $numbers[$i + 1];
        } elseif ($permutation[$i] === "+") {
          $total += $numbers[$i + 1];
        } else {
          $total *= $numbers[$i + 1];
        }
      }

      if ($total == $result) {
        return $total;
      }
    }

    return false;
  }

  /**
   * Get all permutations of operators.
   *
   * @param integer $count     The number of operators to use.
   * @param array   $operators The operators to use.
   *
   * @return array The permutations.
   */
  public static function getPermutations(int $count, array $operators) : array {
    $permutations = [];
    $totalCombinations = pow(count($operators), $count);

    for ($i = 0; $i < $totalCombinations; $i++) {
      $combination = [];
      $value = $i;

      for ($j = 0; $j < $count; $j++) {
          $combination[] = $operators[$value % count($operators)];
          $value = intdiv($value, count($operators));
      }

      $permutations[] = $combination;
  }
    return $permutations;
  }

  /**
   * Parse a row.
   *
   * @param string $row The row to parse.
   *
   * @return array The result and numbers.
   */
  public static function parseRow(string $row) : array {
    $row = explode(":", $row);
    $result = $row[0];

    $numbers = explode(" ", trim($row[1]));

    return [ $result, $numbers ];
  }

  /**
   * Read data from a file.
   *
   * @param string $filename The name of the file to read.
   *
   * @return array The two collections read from the file.
   */
  public static function readData(string $filename) : array {
    return file($filename, FILE_IGNORE_NEW_LINES);
  }
}
