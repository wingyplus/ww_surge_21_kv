<?php

use PHPUnit\Framework\TestCase;

require_once('./ww_surge_21_kv.php');

final class WwSurge21KvTest extends TestCase {
  private $lk_12month;

  public function setUp() {
    $this->lk_12month = [new ZeroLk(), new Lk(1632), new Lk(1514), new Lk(1357), new Lk(1124), new Lk(1266), new Lk(1121), new Lk(868), new Lk(434), new Lk(405), new Lk(452), new Lk(6), new Lk(48)];
  }

  public function test_calculate_quantities_from_1st_to_1st_month() {
    $from = 1;
    $to = 1;
    $lks = calculate_quantities($this->lk_12month, $from, $to);
    $this->assertEquals(1632, $lks[$from]->quantity);
    // make sure 2nd month not set to 0.
    $this->assertEquals(1514, $lks[2]->quantity);
  }

  public function test_calculate_quantities_from_1st_to_2nd_month() {
    $from = 1;
    $to = 2;
    $lks = calculate_quantities($this->lk_12month, $from, $to);
    $this->assertEquals(3146, $lks[$from]->quantity);
    $this->assertEquals(0, $lks[$to]->quantity);
  }

  public function test_calculate_quantities_from_10th_to_11th_month() {
    $from = 10;
    $to = 11;
    $lks = calculate_quantities($this->lk_12month, $from, $to);
    $this->assertEquals(458, $lks[$from]->quantity);
    $this->assertEquals(0, $lks[$to]->quantity);
  }

  public function test_calculate_beginning_inventory() {
    $lks = $this->lk_12month;
    $beginning_inventory = calculate_beginning_inventory($lks[0], $lks[1]);
    $this->assertEquals(1632, $beginning_inventory);
  }

  public function test_calculate_inventory_12months_buy_equals_demand() {
    $lks = calculate_inventory_12months($this->lk_12month);
    foreach ($lks as $lk) {
      $this->assertEquals(0, $lk->ending_inventory);
    }
  }

  public function test_calculate_inventory_12months_have_ending_inventory_when_buy_more_than_demand() {
    $lks = calculate_quantities($this->lk_12month, 1, 2);
    $lks = calculate_inventory_12months($lks);
    $this->assertEquals(3146, $lks[1]->beginning_inventory);
    $this->assertEquals(1514, $lks[1]->ending_inventory);
  }

  public function test_calculate_inventory_12months_have_ending_inventory_when_buy_more_than_demand_2() {
    $lks = calculate_quantities($this->lk_12month, 10, 11);
    $lks = calculate_inventory_12months($lks);
    $this->assertEquals(6, $lks[11]->beginning_inventory);
    $this->assertEquals(0, $lks[11]->ending_inventory);
  }

  public function test_calculate_inventory_12months_calculate_average() {
    $lks = calculate_inventory_12months($this->lk_12month);
    $expected = [0, 816, 757, 678.5, 562, 633, 560.5, 434, 217, 202.5, 226, 3, 24];

    for ($i = 1; $i < count($lks); $i++) {
      $this->assertEquals($expected[$i], $lks[$i]->average_inventory);
    }
  }
}
