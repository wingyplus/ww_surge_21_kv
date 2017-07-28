<?php

class Lk {
  public $demand;
  public $quantity;
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
