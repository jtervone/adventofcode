<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use Adventofcode\Config;
use Adventofcode\Year2024\Day08;

final class Day08Test extends TestCase {
  /**
   * Test the solve1stHalf method of Day08.
   *
   * @return void
   */
  public function test1stHalf() : void {
    // Test input
    $map = Day08::readData(Config::$rootPath."/data/2024/input-08.txt");
    $antennas = Day08::findAntennas($map);
    $result = count(Day08::findAntinodes($antennas, $map));

    $this->assertEquals(14, $result);

    // Real input
    $map = Day08::readData(dirname(Config::$rootPath)."/data/2024/input-08.txt");
    $antennas = Day08::findAntennas($map);
    $result = count(Day08::findAntinodes($antennas, $map));

    $this->assertEquals(379, $result);
  }

  /**
   * Test the solve2ndHalf method of Day07.
   *
   * @return void
   */
  public function test2ndHalf() : void {
    // Test input
    $map = Day08::readData(Config::$rootPath."/data/2024/input-08.txt");
    $antennas = Day08::findAntennas($map);
    $result = count(Day08::findAntinodes($antennas, $map, true));

    $this->assertEquals(34, $result);

    // Real input
    $map = Day08::readData(dirname(Config::$rootPath)."/data/2024/input-08.txt");
    $antennas = Day08::findAntennas($map);
    $result = count(Day08::findAntinodes($antennas, $map, true));

    $this->assertEquals(1339, $result);
  }
}
