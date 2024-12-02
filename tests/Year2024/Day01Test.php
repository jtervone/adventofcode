<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use Adventofcode\Config;
use Adventofcode\Year2024\Day01;

final class Day01Test extends TestCase {
  protected $col1 = [];
  protected $col2 = [];

  /**
   * Set up the test data.
   *
   * @return void
   */
  public function setUp() : void {
    list($col1, $col2) = Day01::readData(Config::$rootPath."/data/2024/input-01.txt");

    $this->col1 = $col1;
    $this->col2 = $col2;
  }

  /**
   * Test the readData function.
   *
   * @return void
   */
  public function testReadData() : void {
    for ($i = 0; $i < count($this->col1); $i++) {
      if ($i == 0) {
        $this->assertEquals(1, $this->col1[$i]);
        $this->assertEquals(3, $this->col2[$i]);
      } else if ($i == 1) {
        $this->assertEquals(2, $this->col1[$i]);
        $this->assertEquals(3, $this->col2[$i]);
      } else if ($i == 2) {
        $this->assertEquals(3, $this->col1[$i]);
        $this->assertEquals(3, $this->col2[$i]);
      }
    }
  }

  /**
   * Test calculateDistance function.
   *
   * @return void
   */
  public function testCalculateDistance() : void {
    $distance = Day01::calculateDistance($this->col1, $this->col2);

    $this->assertEquals(11, $distance);
  }

  /**
   * Test calculateSimularity function.
   *
   * @return void
   */
  public function testCalculateSimularity() : void {
    $similarity = Day01::calculateSimularity($this->col1, $this->col2);

    $this->assertEquals(31, $similarity);
  }
}
