<?php

namespace Adventofcode\Year2024;

use Adventofcode\Config;

class Day08 {
  /**
   * Solve the first half of the day's puzzle.
   *
   * @return void
   */
  public static function solve1stHalf() : void {
    $filename = Config::$rootPath . "/data/2024/input-08.txt";

    $start = microtime(true);
    $map = self::readData($filename);
    $antennas = self::findAntennas($map);
    $antinodes = self::findAntinodes($antennas, $map);
    $result = count($antinodes);

    /*
    echo "\n";
    self::printMap($map);
    echo "\n";

    foreach ($antinodes as $antinode) {
      if ($map[$antinode["y"]][$antinode["x"]] === ".") {
        $map[$antinode["y"]][$antinode["x"]] = "#";
      }
    }

    self::printMap($map);
    echo "\n";
    */

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
    $filename = Config::$rootPath . "/data/2024/input-08.txt";

    $start = microtime(true);
    $map = self::readData($filename);
    $antennas = self::findAntennas($map);
    $antinodes = self::findAntinodes($antennas, $map, true);
    $result = count($antinodes);

    /*
    echo "\n";
    self::printMap($map);
    echo "\n";

    foreach ($antinodes as $antinode) {
      if ($map[$antinode["y"]][$antinode["x"]] === ".") {
        $map[$antinode["y"]][$antinode["x"]] = "#";
      }
    }

    self::printMap($map);
    echo "\n";
    */

    $end = microtime(true);

    echo "2nd half:\n";
    echo "- result: {$result}\n";
    echo "- time: " . (($end - $start) * 100) . "ms\n\n";
  }

  /**
   * Find antennas in the map.
   *
   * @param array $map The map to search for antennas.
   *
   * @return array The antennas found in the map.
   */
  public static function findAntennas(array $map) : array {
    $antennas = [];

    for ($y = 0; $y < count($map); $y++) {
      for ($x = 0; $x < count($map[$y]); $x++) {
        $type = $map[$y][$x];

        if ($type !== ".") {
          $antennas[] = [
            "y" => $y,
            "x" => $x,
            "type" => $type,
          ];
        }
      }
    }

    return $antennas;
  }

  /**
   * Find antinodes in the map.
   *
   * @param array   $antennas The antennas to use to find the antinodes.
   * @param array   $map      The map to search for antinodes.
   * @param boolean $fill     Whether to fill the antinodes.
   *
   * @return array The antinodes found in the map.
   */
  public static function findAntinodes(array $antennas, array $map, bool $fill = false) : array {
    $antinodes = [];

    foreach ($antennas as $i => $a1) {
      foreach ($antennas as $j => $a2) {
        if ($a1["type"] !== $a2["type"] || $a1["x"] === $a2["x"] || $a1["y"] === $a2["y"]) {
          continue;
        }
        $distanceX = $a2["x"] - $a1["x"];
        $distanceY = $a2["y"] - $a1["y"];

        if ($fill) {
          $antinodes[$a1["x"] . " " . $a1["y"]] = [
            "y" => $a1["y"],
            "x" => $a1["x"],
          ];
        }

        $tmpX = $a1["x"] - $distanceX;
        $tmpY = $a1["y"] - $distanceY;

        if ($tmpX >= 0 && $tmpX < count($map[0]) && $tmpY >= 0 && $tmpY < count($map)) {
          $antinodes[$tmpX . " " . $tmpY] = [
            "y" => $tmpY,
            "x" => $tmpX,
          ];

          if ($fill) {
            while ($tmpX >= 0 && $tmpX < count($map[0]) && $tmpY >= 0 && $tmpY < count($map)) {
              $tmpX -= $distanceX;
              $tmpY -= $distanceY;
              if ($tmpX >= 0 && $tmpX < count($map[0]) && $tmpY >= 0 && $tmpY < count($map)) {
                $antinodes[$tmpX . " " . $tmpY] = [
                  "y" => $tmpY,
                  "x" => $tmpX,
                ];
              }
            }
          }
        }

        $tmpX = $a1["x"] + $distanceX * 2;
        $tmpY = $a1["y"] + $distanceY * 2;

        if ($tmpX >= 0 && $tmpX < count($map[0]) && $tmpY >= 0 && $tmpY < count($map)) {
          $antinodes[$tmpX . " " . $tmpY] = [
            "y" => $tmpY,
            "x" => $tmpX,
          ];

          if ($fill) {
            while ($tmpX >= 0 && $tmpX < count($map[0]) && $tmpY >= 0 && $tmpY < count($map)) {
              $tmpX += $distanceX;
              $tmpY += $distanceY;
              if ($tmpX >= 0 && $tmpX < count($map[0]) && $tmpY >= 0 && $tmpY < count($map)) {
                $antinodes[$tmpX . " " . $tmpY] = [
                  "y" => $tmpY,
                  "x" => $tmpX,
                ];
              }
            }
          }
        }
      }
    }

    return $antinodes;
  }

  /**
   * Print a map.
   *
   * @param array $map The map to print.
   *
   * @return void
   */
  public static function printMap(array $map) : void {
    foreach ($map as $row) {
      echo implode("", $row) . "\n";
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
    $data = file($filename, FILE_IGNORE_NEW_LINES);

    $map = [];

    foreach ($data as $row) {
      $row = str_replace("#", ".", $row);
      $map[] = str_split($row);
    }

    return $map;
  }
}
