<?php

class Lk {
  public $demand;
  public $quantiy;
  public $beginning_inventory;
  public $ending_inventory;
  public $average_inventory;

  function __construct($demand) {
    $this->demand = $demand;
    // assume quantity in month should be same demand.
    $this->quantity = $demand;
    $this->beginning_inventory = 0;
    $this->ending_inventory = 0;
    $this->average_inventory = 0;
  }
}

class ZeroLk extends Lk {

  function __construct($demand = 0) {
    parent::__construct($demand);
  }
}

$lk_12month = [new ZeroLk(), new Lk(1632), new Lk(1514), new Lk(1357), new Lk(1124), new Lk(1266), new Lk(1121), new Lk(868), new Lk(434), new Lk(405), new Lk(452), new Lk(6), new Lk(48)];

// calculate 12th month quantities from demands
function calculate_quantities($lks, $from, $to) {
  $sum = 0;
  for ($i = $from; $i <= $to; $i++) {
    $sum += $lks[$i]->demand;
  }
  // set summary demands to $from month
  $lks[$from]->quantity = $sum;
  // set 0 after $from month to $to month
  for ($i = $from+1; $i <= $to; $i++) {
    $lks[$i]->quantity = 0;
  }
  return $lks;
}
