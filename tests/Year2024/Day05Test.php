<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use Adventofcode\Config;
use Adventofcode\Year2024\Day05;

final class Day05Test extends TestCase {
  /**
   * Test the solve1stHalf method of Day05.
   *
   * @return void
   */
  public function test1stHalf() : void {
    // Test input
    $filename = Config::$rootPath."/data/2024/input-05.txt";
    $result = Day05::solve1($filename);

    $this->assertEquals(143, $result);

    // Real input
    $filename = dirname(Config::$rootPath)."/data/2024/input-05.txt";
    $result = Day05::solve1($filename);

    $this->assertEquals(4924, $result);
  }

  /**
   * Test the solve2ndHalf method of Day05.
   *
   * @return void
   */
  public function test2ndHalf() : void {
    // Test input
    $filename = Config::$rootPath."/data/2024/input-05.txt";
    $result = Day05::solve2($filename);

    $this->assertEquals(123, $result);

    // Real input
    $filename = dirname(Config::$rootPath)."/data/2024/input-05.txt";
    $result = Day05::solve2($filename);

    $this->assertEquals(6085, $result);
  }
}
