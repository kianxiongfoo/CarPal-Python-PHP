<?php
/**
 * Created by PhpStorm.
 * User: Archit
 * Date: 9/9/2018
 * Time: 7:42 PM
 */
include 'TenPinBall.php';

$tpball = new TenPinBall([[5,5],[8,1],[6,4],[10],[0,5],[2,6],[8,1],[5,3],[6,1],[10,2,6]]);
$tpball->getResults();