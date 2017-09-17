<?php

use PHPUnit\Framework\TestCase;

require_once('./ww_surge_21_kv.php');

final class HighVoltageSurgeArrester21kVTest extends TestCase {
  private $lk_12month;

  public function setUp() {
    $this->lk_12month = [new ZeroLk(), new Lk(1632), new Lk(1514), new Lk(1357), new Lk(1124), new Lk(1266), new Lk(1121), new Lk(868), new Lk(434), new Lk(405), new Lk(452), new Lk(6), new Lk(48)];
  }

  public function test_calculate_first_month() {
    $hvsa = new HighVoltageSurgeArrester($this->lk_12month);
    $this->assertEquals(23694, $hvsa->calculate(1, 1));
  }

  public function test_calculate_second_month() {
    $hvsa = new HighVoltageSurgeArrester($this->lk_12month);
    $this->assertEquals(88039, $hvsa->calculate(2, 1));
  }

  public function test_calculate_third_month() {
    $hvsa = new HighVoltageSurgeArrester($this->lk_12month);
    $this->assertEquals(184174, $hvsa->calculate(3, 1));
  }
}
