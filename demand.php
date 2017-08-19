<?php

require_once('./ww_surge_21_kv.php');

$lk_12month = [new ZeroLk(), new Lk(1632), new Lk(1514), new Lk(1357), new Lk(1124), new Lk(1266), new Lk(1121), new Lk(868), new Lk(434), new Lk(405), new Lk(452), new Lk(6), new Lk(48)];
calculate_quantities($lk_12month, 1, 2);
calculate_inventory_12months($lk_12month);
