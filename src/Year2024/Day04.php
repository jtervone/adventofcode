<?php

namespace Adventofcode\Year2024;

use Adventofcode\Config;

class Day04 {
  /**
   * Solve the first half of the day's puzzle.
   *
   * @return void
   */
  public static function solve1stHalf() : void {
    $filename = Config::$rootPath . "/data/2024/input-04.txt";

    $start = microtime(true);

    $result = self::calculateXmases1($filename);

    $end = microtime(true);

    echo "1st half:\n";
    echo "- result: {$result}\n";
    echo "- time: " . (($end - $start) * 100) . "ms\n\n";
  }

  /**
   * Solve the second half of the day's puzzle.
   *
   * @return void
   */
  public static function solve2ndHalf() : void {
    $filename = Config::$rootPath . "/data/2024/input-04.txt";

    $start = microtime(true);

    $result = self::calculateXmases2($filename);

    $end = microtime(true);

    echo "2nd half:\n";
    echo "- result: {$result}\n";
    echo "- time: " . (($end - $start) * 100) . "ms\n\n";
  }

  /**
   * Calculate the number of XMAS patterns in the data.
   *
   * @param string $filename The name of the file to read.
   *
   * @return integer The number of XMAS patterns found.
   */
  public static function calculateXmases1($filename) : int {
    $count = 0;
    $data = self::readData($filename);

    for ($y = 0; $y < count($data); $y++) {
      for ($x = 0; $x < count($data[$y]); $x++) {
        $count += self::isInvolvedXmas1($data, $x, $y);
      }
    }

    return $count;
  }

  /**
   * Calculate the number of XMAS patterns in the data.
   *
   * @param string $filename The name of the file to read.
   *
   * @return integer The number of XMAS patterns found.
   */
  public static function calculateXmases2($filename) : int {
    $count = 0;
    $data = self::readData($filename);

    for ($y = 0; $y < count($data); $y++) {
      for ($x = 0; $x < count($data[$y]); $x++) {
        $count += self::isInvolvedXmas2($data, $x, $y);
      }
    }

    return $count;
  }

  /**
   * Check if the current position is involved in an XMAS pattern.
   *
   * @param array   $data The data to check.
   * @param integer $x    The x position.
   * @param integer $y    The y position.
   *
   * @return boolean True if the position is involved in an XMAS pattern, false otherwise.
   */
  public static function isInvolvedXmas1(
    array &$data,
    int $x,
    int $y
  ) : int {
    $xmasses = 0;

    if ($data[$y][$x] === "X") {
      // left to right
      if (!empty($data[$y][$x + 1]) && ($data[$y][$x + 1] === "M")) {
        if (!empty($data[$y][$x + 2]) && ($data[$y][$x + 2] === "A")) {
          if (!empty($data[$y][$x + 3]) && ($data[$y][$x + 3] === "S")) {
            $xmasses++;
          }
        }
      }
      // right to left
      if (!empty($data[$y][$x - 1]) && ($data[$y][$x - 1] === "M")) {
        if (!empty($data[$y][$x - 2]) && ($data[$y][$x - 2] === "A")) {
          if (!empty($data[$y][$x - 3]) && ($data[$y][$x - 3] === "S")) {
            $xmasses++;
          }
        }
      }
      // top to bottom
      if (!empty($data[$y + 1][$x]) && ($data[$y + 1][$x] === "M")) {
        if (!empty($data[$y + 2][$x]) && ($data[$y + 2][$x] === "A")) {
          if (!empty($data[$y + 3][$x]) && ($data[$y + 3][$x] === "S")) {
            $xmasses++;
          }
        }
      }
      // bottom to top
      if (!empty($data[$y - 1][$x]) && ($data[$y - 1][$x] === "M")) {
        if (!empty($data[$y - 2][$x]) && ($data[$y - 2][$x] === "A")) {
          if (!empty($data[$y - 3][$x]) && ($data[$y - 3][$x] === "S")) {
            $xmasses++;
          }
        }
      }
      // top left to bottom right
      if (!empty($data[$y + 1][$x + 1]) && ($data[$y + 1][$x + 1] === "M")) {
        if (!empty($data[$y + 2][$x + 2]) && ($data[$y + 2][$x + 2] === "A")) {
          if (!empty($data[$y + 3][$x + 3]) && ($data[$y + 3][$x + 3] === "S")) {
            $xmasses++;
          }
        }
      }
      // top right to bottom left
      if (!empty($data[$y + 1][$x - 1]) && ($data[$y + 1][$x - 1] === "M")) {
        if (!empty($data[$y + 2][$x - 2]) && ($data[$y + 2][$x - 2] === "A")) {
          if (!empty($data[$y + 3][$x - 3]) && ($data[$y + 3][$x - 3] === "S")) {
            $xmasses++;
          }
        }
      }
      // bottom right to top left
      if (!empty($data[$y - 1][$x - 1]) && ($data[$y - 1][$x - 1] === "M")) {
        if (!empty($data[$y - 2][$x - 2]) && ($data[$y - 2][$x - 2] === "A")) {
          if (!empty($data[$y - 3][$x - 3]) && ($data[$y - 3][$x - 3] === "S")) {
            $xmasses++;
          }
        }
      }
      // bottom left to top right
      if (!empty($data[$y - 1][$x + 1]) && ($data[$y - 1][$x + 1] === "M")) {
        if (!empty($data[$y - 2][$x + 2]) && ($data[$y - 2][$x + 2] === "A")) {
          if (!empty($data[$y - 3][$x + 3]) && ($data[$y - 3][$x + 3] === "S")) {
            $xmasses++;
          }
        }
      }
    }

    return $xmasses;
  }

  /**
   * Check if the current position is involved in an MAS pattern in X shape.
   *
   * @param array   $data The data to check.
   * @param integer $x    The x position.
   * @param integer $y    The y position.
   *
   * @return integer The number of XMAS patterns found.
   */
  public static function isInvolvedXmas2(
    array &$data,
    int $x,
    int $y
  ) : int {
    $xmasses = 0;

    // M.S
    // .A.
    // M.S
    if (
        (!empty($data[$y][$x]) && ($data[$y][$x] === "M")) &&
        (!empty($data[$y][$x + 2]) && ($data[$y][$x + 2] === "S")) &&
        (!empty($data[$y + 1][$x + 1]) && ($data[$y + 1][$x + 1] === "A")) &&
        (!empty($data[$y + 2][$x]) && ($data[$y + 2][$x] === "M")) &&
        (!empty($data[$y + 2][$x + 2]) && ($data[$y + 2][$x + 2] === "S"))
    ) {
      $xmasses++;
    }

    // S.S
    // .A.
    // M.M
    if (
        (!empty($data[$y][$x]) && ($data[$y][$x] === "S")) &&
        (!empty($data[$y][$x + 2]) && ($data[$y][$x + 2] === "S")) &&
        (!empty($data[$y + 1][$x + 1]) && ($data[$y + 1][$x + 1] === "A")) &&
        (!empty($data[$y + 2][$x]) && ($data[$y + 2][$x] === "M")) &&
        (!empty($data[$y + 2][$x + 2]) && ($data[$y + 2][$x + 2] === "M"))
    ) {
      $xmasses++;
    }

    // M.M
    // .A.
    // S.S
    if (
        (!empty($data[$y][$x]) && ($data[$y][$x] === "M")) &&
        (!empty($data[$y][$x + 2]) && ($data[$y][$x + 2] === "M")) &&
        (!empty($data[$y + 1][$x + 1]) && ($data[$y + 1][$x + 1] === "A")) &&
        (!empty($data[$y + 2][$x]) && ($data[$y + 2][$x] === "S")) &&
        (!empty($data[$y + 2][$x + 2]) && ($data[$y + 2][$x + 2]) === "S")
    ) {
      $xmasses++;
    }

    // S.M
    // .A.
    // S.M
    if (
        (!empty($data[$y][$x]) && ($data[$y][$x] === "S")) &&
        (!empty($data[$y][$x + 2]) && ($data[$y][$x + 2] === "M")) &&
        (!empty($data[$y + 1][$x + 1]) && ($data[$y + 1][$x + 1] === "A")) &&
        (!empty($data[$y + 2][$x]) && ($data[$y + 2][$x] === "S")) &&
        (!empty($data[$y + 2][$x + 2]) && ($data[$y + 2][$x + 2] === "M"))
    ) {
      $xmasses++;
    }

    return $xmasses;
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
