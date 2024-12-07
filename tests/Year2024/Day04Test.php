<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use Adventofcode\Config;
use Adventofcode\Year2024\Day04;

final class Day04Test extends TestCase {
  /**
   * Test the solve1stHalf method of Day04.
   *
   * @return void
   */
  public function test1stHalf() : void {
    // Test input
    $filename = Config::$rootPath."/data/2024/input-04.txt";
    $result = Day04::calculateXmases1($filename);

    $this->assertEquals(18, $result);

    // Real input
    $filename = dirname(Config::$rootPath)."/data/2024/input-04.txt";
    $result = Day04::calculateXmases1($filename);

    $this->assertEquals(2378, $result);
  }

  /**
   * Test the solve2ndHalf method of Day04.
   *
   * @return void
   */
  public function test2ndHalf() : void {
    // Test input
    $filename = Config::$rootPath."/data/2024/input-04.txt";
    $result = Day04::calculateXmases2($filename);

    $this->assertEquals(9, $result);

    // Real input
    $filename = dirname(Config::$rootPath)."/data/2024/input-04.txt";
    $result = Day04::calculateXmases2($filename);

    $this->assertEquals(1796, $result);
  }
}
