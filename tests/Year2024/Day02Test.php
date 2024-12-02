<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use Adventofcode\Config;
use Adventofcode\Year2024\Day02;

final class Day02Test extends TestCase {
  protected $data = [];

  /**
   * Set up the test data.
   *
   * @return void
   */
  public function setUp() : void {
    $this->data = Day02::readData(Config::$rootPath."/data/2024/input-02.txt");
  }

  /**
   * Test calculateDistance function.
   *
   * @return void
   */
  public function testValidateRows() : void {
    $valids = [
      true,
      false,
      false,
      false,
      false,
      true,
    ];

    foreach ($this->data as $num => $row) {
      $validRow = Day02::validateRow($row);
      $this->assertEquals($valids[$num], $validRow);
    }
  }

  public function testValidateRowsWithDampener() : void {
    $valids = [
      true,
      false,
      false,
      true,
      true,
      true,
    ];

    foreach ($this->data as $num => $row) {
      $validRow = Day02::validateRowDampener($row);
      $this->assertEquals($valids[$num], $validRow);
    }
  }
}
