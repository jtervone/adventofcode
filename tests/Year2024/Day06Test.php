<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use Adventofcode\Config;
use Adventofcode\Year2024\Day06;

final class Day06Test extends TestCase {
  /**
   * Test the solve1stHalf method of Day06.
   *
   * @return void
   */
  public function test1stHalf() : void {
    // Test input
    $filename = Config::$rootPath."/data/2024/input-06.txt";
    $result = Day06::calculateMoves1($filename);

    $this->assertEquals(41, $result);

    // Real input
    $filename = dirname(Config::$rootPath)."/data/2024/input-06.txt";
    $result = Day06::calculateMoves1($filename);

    $this->assertEquals(5145, $result);
  }

  /**
   * Test the solve2ndHalf method of Day06.
   *
   * @return void
   */
  public function test2ndHalf() : void {
    // Test input
    $filename = Config::$rootPath."/data/2024/input-06.txt";
    $result = Day06::calculateMoves2($filename);

    $this->assertEquals(6, $result);

    // Real input
    $filename = dirname(Config::$rootPath)."/data/2024/input-06.txt";
    $result = Day06::calculateMoves2($filename);

    $this->assertEquals(1523, $result);
  }
}
