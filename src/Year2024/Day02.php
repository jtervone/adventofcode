<?php

namespace Adventofcode\Year2024;

use Adventofcode\Config;

class Day02 {
  public static function solve1stHalf() {
    $validRows = 0;
    $filename = Config::$rootPath . "/data/2024/input-02.txt";

    $data = self::readData($filename);

    $start = microtime(true);
    foreach ($data as $num => $row) {
      $validRow = self::validateRow($row);
      if ($validRow) {
        $validRows++;
      }
    }
    $end = microtime(true);

    echo "1st half:\n";
    echo "- valid rows: {$validRows}\n";
    echo "- time: " . (($end - $start) * 100) . "ms\n\n";
  }

  public static function solve2ndHalf() {
    $validRows = 0;
    $filename = Config::$rootPath . "/data/2024/input-02.txt";

    $data = self::readData($filename);

    $start = microtime(true);
    foreach ($data as $num => $row) {
      $validRow = self::validateRowDampener($row);
      if ($validRow) {
        $validRows++;
      }
    }
    $end = microtime(true);

    echo "2nd half:\n";
    echo "- valid rows: {$validRows}\n";
    echo "- time: " . (($end - $start) * 100) . "ms\n";
  }

  /**
   * Validate single row.
   *
   * @param array $row The row to validate.
   *
   * @return bool True if the row is valid, false otherwise.
   */
  public static function validateRow(array $row) : bool {
    $lastNum = null;
    $secondNum = null;
    $increase = false;

    foreach ($row as $num) {
      if ($lastNum) {
        if (!$secondNum) {
          $secondNum = $num;

          if ($secondNum > $lastNum) {
            $increase = true;
          }
        }

        if ($num == $lastNum) {
          return false;
        }

        if ($increase) {
          if ($num < $lastNum) {
            return false;
          }

          if (($num - $lastNum) > 3) {
            return false;
          }
        } elseif (!$increase) {
          if ($num > $lastNum) {
            return false;
          }

          if (($lastNum - $num) > 3) {
            return false;
          }
        }
      }

      $lastNum = $num;
    }

    return true;
  }

  /**
   * Validate single row with dampener. Allows for one number to be removed.
   *
   * @param array $row The row to validate.
   *
   * @return bool True if the row is valid, false otherwise.
   */
  public static function validateRowDampener(array $row) : bool {
    $valid = self::validateRow($row);

    if ($valid) {
      return true;
    }

    for ($i = 0; $i < count($row); $i++) {
      $tmp = $row;
      unset($tmp[$i]);

      $valid = self::validateRow($tmp);

      if ($valid) {
        return true;
      }
    }

    return false;
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
    $data = file($filename, FILE_IGNORE_NEW_LINES);

    foreach ($data as $row) {
      $output[] = explode(" ", $row);
    }

    return $output;
  }
}
