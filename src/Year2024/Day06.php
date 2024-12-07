<?php

namespace Adventofcode\Year2024;

use Adventofcode\Config;

class Day06 {
  /**
   * Solve the first half of the day's puzzle.
   *
   * @return void
   */
  public static function solve1stHalf() : void {
    $filename = Config::$rootPath . "/data/2024/input-06.txt";

    $start = microtime(true);

    $moves = self::calculateMoves($filename);

    $end = microtime(true);

    echo "1st half:\n";
    echo "- result: {$moves}\n";
    echo "- time: " . (($end - $start) * 100) . "ms\n\n";
  }

  /**
   * Solve the second half of the day's puzzle.
   *
   * @return void
   */
  public static function solve2ndHalf() : void {
    $filename = Config::$rootPath . "/data/2024/input-06.txt";

    $start = microtime(true);

    $positions = self::calculateExtraWallPositions($filename);

    $end = microtime(true);
    echo "2nd half:\n";
    echo "- result: {$positions}\n";
    echo "- time: " . (($end - $start) * 100) . "ms\n\n";
  }

  /**
   * Calculate the number of moves the guard makes.
   *
   * @param string $filename The name of the file to read.
   *
   * @return integer The number of moves the guard makes.
   */
  public static function calculateMoves($filename) {
    $count = 0;
    $direction = "up";

    list($map, $y, $x) = self::readData($filename);
    do {
      if ($map[$y][$x] !== "X") {
        $count++;
      }
      $map[$y][$x] = "X";
      if (self::shouldTurnRight($map, $x, $y, $direction)) {
        $direction = self::turnRight($direction);
      } else {
        self::move($map, $x, $y, $direction);
      }
      // self::printMap($map);
    } while ($direction !== null);

    return $count;
  }

  /**
   * Calculate the number of extra wall positions.
   *
   * @param string $filename The name of the file to read.
   *
   * @return integer The number of extra wall positions.
   */
  public static function calculateExtraWallPositions($filename) {
    list($origMap, $origY, $origX) = self::readData($filename);

    $count = 0;

    for ($yy = 0; $yy < count($origMap); $yy++) {
      for ($xx = 0; $xx < count($origMap[$yy]); $xx++) {
        if ($origMap[$yy][$xx] !== ".") {
          continue;
        }
        $samePlace = false;
        $map = $origMap;
        $map[$yy][$xx] = "#";
        $direction = "up";
        $x = $origX;
        $y = $origY;
        $turns = [];

        do {
          $map[$y][$x] = "X";
          if (self::shouldTurnRight($map, $x, $y, $direction)) {
            if (!empty($turns[$y][$x][$direction])) {
              $samePlace = true;
            }
            $turns[$y][$x][$direction] = true;
            $direction = self::turnRight($direction);
          } else {
            self::move($map, $x, $y, $direction);
          }
          // self::printMap($map);
        } while ($direction !== null && !$samePlace);
        if ($samePlace) {
          $count++;
        }
      }
    }

    return $count;
  }

  /**
   * Check if the robot should turn right.
   *
   * @param array   $map       The map to check.
   * @param integer $x         The x position of the robot.
   * @param integer $y         The y position of the robot.
   * @param string  $direction The direction the robot is facing.
   *
   * @return boolean True if the guard should turn right, false otherwise.
   */
  public static function shouldTurnRight(array &$map, int $x, int $y, string $direction) : bool {
    if ($direction == "up") {
      $next = $map[$y - 1][$x] ?? null;
    } elseif ($direction == "right") {
      $next = $map[$y][$x + 1] ?? null;
    } elseif ($direction == "down") {
      $next = $map[$y + 1][$x] ?? null;
    } elseif ($direction == "left") {
      $next = $map[$y][$x - 1] ?? null;
    } else {
      return false;
    }

    return $next === "#";
  }

  /**
   * Print the map.
   *
   * @param array $map The map to print.
   *
   * @return void
   */
  public static function printMap(array &$map) : void {
    echo chr(27) . chr(91) . "H" . chr(27) . chr(91) . "J"; //^[H^[J
    for ($y = 0; $y < count($map); $y++) {
      for ($x = 0; $x < count($map[$y]); $x++) {
        echo $map[$y][$x];
      }
      echo "\n";
    }
    usleep(5000);
  }

  /**
   * Move the guard.
   *
   * @param array   $map       The map to move on.
   * @param integer $x         The x position of the guard.
   * @param integer $y         The y position of the guard.
   * @param string  $direction The direction the guard is facing.
   *
   * @return void
   */
  public static function move(array &$map, int &$x, int &$y, string &$direction) : void {
    $newX = $x;
    $newY = $y;

    if ($direction == "up") {
      $newY--;
    } elseif ($direction == "down") {
      $newY++;
    } elseif ($direction == "left") {
      $newX--;
    } elseif ($direction == "right") {
      $newX++;
    }

    if (empty($map[$newY][$newX])) {
      $direction = null;
    } else {
      $x = $newX;
      $y = $newY;
    }
  }

  /**
   * Turn the guard right.
   *
   * @param string $direction The direction the guard is facing.
   *
   * @return string The new direction the guard is facing.
   */
  public static function turnRight(string $direction) : string {
    if ($direction == "up") {
      return "right";
    } elseif ($direction == "right") {
      return "down";
    } elseif ($direction == "down") {
      return "left";
    } elseif ($direction == "left") {
      return "up";
    }
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

    $posX = null;
    $posY = null;
    for ($y = 0; $y < count($data); $y++) {
      $tmp = strpos($data[$y], "^");
      if ($tmp !== false) {
        $posX = $tmp;
        $posY = $y;
      }
      $output[$y] = str_split($data[$y]);
    }

    return [ $output, $posY, $posX ];
  }
}
