<?php

use PHPUnit\Framework\TestCase;

require_once('./ww_surge_21_kv.php');

final class WwSurge21KvTest extends TestCase {
  public function test_calculate_quantities_from_1st_to_1st_month() {
    $from = 1;
    $to = 1;
    $lks = calculate_quantities($GLOBALS['lk_12month'], $from, $to);
    $this->assertEquals(1632, $lks[$from]->quantity);
    // make sure 2nd month not set to 0.
    $this->assertEquals(1514, $lks[2]->quantity);
  }

  public function test_calculate_quantities_from_1st_to_2nd_month() {
    $from = 1;
    $to = 2;
    $lks = calculate_quantities($GLOBALS['lk_12month'], $from, $to);
    $this->assertEquals(3146, $lks[$from]->quantity);
    $this->assertEquals(0, $lks[$to]->quantity);
  }

  public function test_calculate_quantities_from_10th_to_11th_month() {
    $from = 10;
    $to = 11;
    $lks = calculate_quantities($GLOBALS['lk_12month'], $from, $to);
    $this->assertEquals(458, $lks[$from]->quantity);
    $this->assertEquals(0, $lks[$to]->quantity);
  }
}
