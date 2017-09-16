<?php

// refer to C in $R$21
define('C', 1700);

// refer to S in $R$19
define('S', 148000 / 3 / 86);

// refer to H in $R$22
define('H', C * (0.2 / 12));

class Lk {
  public $demand;
  public $quantity;
  public $beginning_inventory;
  public $ending_inventory;
  public $average_inventory;
  public $round_holding_cost;
  public $ordering_cost;

  function __construct($demand) {
    $this->demand = $demand;
    // assume quantity in month should be same demand.
    $this->quantity = $demand;
    $this->beginning_inventory = 0;
    $this->ending_inventory = 0;
    $this->average_inventory = 0;
    $this->round_holding_cost = 0;
    $this->ordering_cost = 0;
  }
}

class ZeroLk extends Lk {

  function __construct($demand = 0) {
    parent::__construct($demand);
  }
}


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

function calculate_beginning_inventory($lk0, $lk1) {
  return $lk0->ending_inventory + $lk1->quantity;
}

function calculate_ending_inventory($lk) {
  return $lk->beginning_inventory - $lk->demand;
}

function calculate_average_inventory($lk) {
  return ($lk->beginning_inventory + $lk->ending_inventory) / 2;
}

function calculate_inventory_12months($lks) {
  for ($i = 1; $i < count($lks); $i++) {
    $lks[$i]->beginning_inventory = calculate_beginning_inventory($lks[$i - 1], $lks[$i]);
    $lks[$i]->ending_inventory = calculate_ending_inventory($lks[$i]);
    $lks[$i]->average_inventory = calculate_average_inventory($lks[$i]);
  }
  return $lks;
}

function calculate_round_holding_cost($lks) {
  for ($i = 1; $i < count($lks); $i++) {
    $lk = $lks[$i];
    $lk->round_holding_cost = round($lk->average_inventory * (0.2 / 12) * C, 2);
  }
  return $lks;
}

function calculate_ordering_cost($lks) {
  for ($i = 1; $i < count($lks); $i++) {
    $lk = $lks[$i];
    if ($lk->quantity != 0) {
      $lk->ordering_cost = S;
    }
  }
}

class HighVoltageSurgeArrester {
  private $lk_12month;

  public function __construct($lk_12month) {
    $this->lk_12month = $lk_12month;
  }

  public function calculate($i, $k) {
    $lks = calculate_quantities($this->lk_12month, $i, $i);
    $lks = calculate_inventory_12months($lks);

    return ceil(S + ($lks[$i]->average_inventory * H));
  }
}
