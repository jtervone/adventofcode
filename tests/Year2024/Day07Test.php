<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use Adventofcode\Config;
use Adventofcode\Year2024\Day07;

final class Day07Test extends TestCase {
  /**
   * Test the solve1stHalf method of Day07.
   *
   * @return void
   */
  public function test1stHalf() : void {
    // Test input
    $data = Day07::readData(Config::$rootPath."/data/2024/input-07.txt");
    $result = Day07::calculateEquation($data, [ "+", "*" ]);

    $this->assertEquals(3749, $result);

    // Real input
    $data = Day07::readData(dirname(Config::$rootPath)."/data/2024/input-07.txt");
    $result = Day07::calculateEquation($data, [ "+", "*" ]);

    $this->assertEquals(12940396350192, $result);
  }

  /**
   * Test the solve2ndHalf method of Day07.
   *
   * @return void
   */
  public function test2ndHalf() : void {
    // Test input
    $data = Day07::readData(Config::$rootPath."/data/2024/input-07.txt");
    $result = Day07::calculateEquation($data, [ "+", "*", "||" ]);

    $this->assertEquals(11387, $result);

    // Real input
    $data = Day07::readData(dirname(Config::$rootPath)."/data/2024/input-07.txt");
    $result = Day07::calculateEquation($data, [ "+", "*", "||" ]);

    $this->assertEquals(106016735664498, $result);
  }
}
