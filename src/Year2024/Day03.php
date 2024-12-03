<?php

namespace Adventofcode\Year2024;

use Adventofcode\Config;

class Day03 {
  /**
   * Solve the first half of the day's puzzle.
   *
   * @return void
   */
  public static function solve1stHalf() : void {
    $filename = Config::$rootPath . "/data/2024/input-03.txt";

    $start = microtime(true);
    $result = self::parserV1($filename);
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
    $filename = Config::$rootPath . "/data/2024/input-03.txt";

    $start = microtime(true);
    $result = self::parserV2($filename);
    $end = microtime(true);

    echo "2nd half:\n";
    echo "- result: {$result}\n";
    echo "- time: " . (($end - $start) * 100) . "ms\n\n";
  }

  /**
   * Parse the file and find mul() functions and calculate the result.
   *
   * Used brute force to find the functions and calculate the result.
   *
   * @param string $filename The name of the file to parse.
   *
   * @return integer The result of the calculation.
   */
  public static function parserV1(string $filename) : int {
    $result = 0;

    $handle = fopen($filename, "r");

    if ($handle) {
      while (false !== ($char = fgetc($handle))) {
        if ($char === "m") {
          while (false !== ($char = fgetc($handle))) {
            if ($char === "u") {
              while (false !== ($char = fgetc($handle))) {
                if ($char === "l") {
                  while (false !== ($char = fgetc($handle))) {
                    if ($char === "(") {
                      $numbers = "";
                      while (false !== ($char = fgetc($handle))) {
                        if ($char === ")") {
                          $tmp = explode(",", $numbers);
                          if (count($tmp) !== 2) {
                            break;
                          }
                          $result += $tmp[0] * $tmp[1];
                          break;
                        } elseif (!is_numeric($char) && ($char !== ",")) {
                          break;
                        }
                        $numbers .= $char;
                      }
                    }
                    break;
                  }
                }
                break;
              }
            }
            break;
          }
        }
      }
    }

    return $result;
  }

  /**
   * Parse the file and find mul() functions and calculate the result.
   *
   * Might use memory too much but works.
   *
   * @param string $filename The name of the file to parse.
   *
   * @return integer The result of the calculation.
   */
  public static function parserV2(string $filename) : int {
    $data = file_get_contents($filename);

    $result = 0;
    $i = 0;
    $do = true;
    do {
      $char = $data[$i] ?? null;

      if (substr($data, $i, 7) === "don't()") {
        $do = false;
      } elseif (substr($data, $i, 4) === "do()") {
        $do = true;
      }

      if ($do && (substr($data, $i, 4) === "mul(")) {
        $i += 4;
        $numbers = "";
        while ($data[$i] !== null) {
          $char = $data[$i];
          if ($char === ")") {
            $tmp = explode(",", $numbers);
            if (count($tmp) !== 2) {
              break;
            }
            $result += $tmp[0] * $tmp[1];
            break;
          } elseif (!is_numeric($char) && ($char !== ",")) {
            break;
          }
          $numbers .= $char;
          $i++;
        }
      }
      $i++;
    } while ($char !== null);

    return $result;
  }

  /**
   * Read data from a file.
   *
   * @param string $filename The name of the file to read.
   *
   * @return array The two collections read from the file.
   */
  public static function readData(string $filename) : array {
    return file_get_contents($filename);
  }
}
