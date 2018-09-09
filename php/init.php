<?php
/**
 * Created by PhpStorm.
 * User: Archit
 * Date: 9/9/2018
 * Time: 7:42 PM
 */
include 'TenPinBall.php';

$tpball = new TenPinBall([[5,2],[8,1],[6,4],[10],[0,5],[2,6],[8,1],[5,3],[6,1],[10,2,6]]);
echo (json_encode($tpball->getResults()))."\n";

$tpball = new TenPinBall([[5,2],[8,1],[6,4],[10],[10],[2,6],[8,1],[5,3],[6,1],[10,2,6]]);
echo (json_encode($tpball->getResults()))."\n";
$tpball = new TenPinBall([[1,3],[2,5],[1,7],[10],[10],[5,3],[2,1],[1,1],[1,3],[10,2,1]]);
echo (json_encode($tpball->getResults()))."\n";



$tpball = new TenPinBall('test string');
echo (json_encode($tpball->getResults()))."\n";

$tpball = new TenPinBall([[8,1],[6,4],[10],[10],[2,6],[8,1],[5,3],[6,1],[10,2,6]]);
echo (json_encode($tpball->getResults()))."\n";

$tpball = new TenPinBall([[10,5],[8, 6], [6, 4], [10], [10], [2, 6], [8, 1], [5, 3], [6, 1], [10, 2, 6]]);
echo (json_encode($tpball->getResults()))."\n";

$tpball = new TenPinBall([[1,5],[1, 6], [6, 4], [10], [10], [2, 6], [8, 1], [5, 3], [6, 1], [10, 12, 6]]);
echo (json_encode($tpball->getResults()))."\n";

$tpball = new TenPinBall([[1,5],[1, 6], [6, 4], [10], [10], [2, 6], [8, 1], [5, 3], [6, 1],  [6, 1],  [6, 1], [10, 12, 6]]);
echo (json_encode($tpball->getResults()))."\n";