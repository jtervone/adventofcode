<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use Adventofcode\Config;
use Adventofcode\Year2024\Day03;

final class Day03Test extends TestCase {
  /**
   * Test parserV1 function.
   *
   * @return void
   */
  public function testValidateRows() : void {
    $result = Day03::parserV1(Config::$rootPath."/data/2024/input-03-01.txt");

    $this->assertEquals(161, $result);
  }

  /**
   * Test parserV2 function.
   *
   * @return void
   */
  public function testValidateRowsWithDampener() : void {
    $result = Day03::parserV2(Config::$rootPath."/data/2024/input-03-02.txt");

    $this->assertEquals(48, $result);
  }
}
