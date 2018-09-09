<?php
/**
 * Created by PhpStorm.
 * User: Archit
 * Date: 9/9/2018
 * Time: 7:42 PM
 */

class TenPinBall
{
    /**
     * @var
     */
    protected $gameData;
    public $errorArray = [];
    public $resultArray = [];
function __construct($gameData)
{
    $this->gameData = $gameData;
    unset($errorArray);
    unset($resultArray);
}

function getResults(){
    $this->validateInput();

    if(isset($this->errorArray[0])){
        $err =  $this->errorArray[0];
        unset($this->errorArray[0]);
        return $err;

       // exit;
    }
    else {
        $index=0;
        foreach ($this->gameData as $frame) {
            array_push($this->resultArray,$this->calculateFrameResult($frame,$index));
            $index = $index + 1;
        }
       return $this->resultArray;
    }
}

private function calculateFrameResult($frame, $index)
{
    if (sizeof($this->resultArray) == 0) {
        $lastElement = 0;
    } else {
        $lastElement = end($this->resultArray);
    }

    if(sizeof($frame)== 1){
        return ($lastElement + $this->calculateStrike(array_sum($frame), $index,0));
    } else {
        return $lastElement + array_sum($frame);
    }
}

private function calculateStrike($sFrame, $sIndex, $stmp){
if(sizeof($this->gameData[$sIndex+1]) == 1 ){
    $stmp = $stmp + $sFrame;
    return $this->calculateStrike(array_sum($this->gameData[$sIndex+1]),$sIndex+1, $stmp);
}
else{
    return $sFrame + array_sum($this->gameData[$sIndex+1]) + $stmp;
}
}
private function validateInput(){
    if (!is_array($this->gameData)){

            $error = "Invalid Game Data";
            array_push($this->errorArray,$error);
            return;
    }
    if(sizeof($this->gameData) != 10) {
        $error = "Invalid Game Data, Expecting 10 Frames, ".sizeof($this->gameData) ." Frames given!";
       array_push($this->errorArray,$error);
        return;
    }
    //Validate Total and Faulty Data
    for($i = 0 ; $i < sizeof($this->gameData)-1; $i++) {
        $tmparr = $this->gameData[$i];
        $min = 0;
        $max = 10;
        if (sizeof($tmparr) == 2) {
            //echo $tmparr[0];

            if (!($tmparr[0] >= $min && $tmparr[0] <= $max)) {
                $error = "sdsadasInvalid Frame Data,  " . $tmparr[0];
                echo (($min <= $tmparr[0]) && ($tmparr[0] <= $max));

                array_push($this->errorArray, $error);
                return;
            }
            if (!($tmparr[1] >= $min && $tmparr[1] <= $max)) {

                $error = "Invalid Frame Data,  " . $tmparr[1];
                array_push($this->errorArray, $error);
                return;
            }

        } elseif (sizeof($tmparr) == 1) {
            if ($tmparr[0] != 10) {

                $error = "Invalid Frame Data,  " . $tmparr[0];
                array_push($this->errorArray, $error);
                return;
            }

            //var_dump($this->gameData[$i]);
        }
        if(array_sum($tmparr) > 10 ){

            $error = "Invalid Score, Score should not exceed to 10, current score " . array_sum($tmparr);
            array_push($this->errorArray, $error);
            return;
        }
    }
    // 10th Frame
    if(sizeof($this->gameData[9]) == 3){

        list($v1, $v2, $v3) = $this->gameData[9];
        if($v1 != 10) {
            $error = "Invalid Data, " .$v1 ." Given";
            array_push($this->errorArray, $error);
            return;
        }
        if($v1 > 10 || $v2 > 10 || $v3 > 10) {
            $error = "Invalid Score, Score should not exceed to 10 each game, current score " . json_encode($this->gameData[9]);
            array_push($this->errorArray, $error);
            return;
        }

        if(array_sum($this->gameData[9]) > 30) {
            $error = "Invalid Score, Score should not exceed to 30, current score " . array_sum($this->gameData[9]);
            array_push($this->errorArray, $error);
            return;
        }
    }
    else{
        list($v1, $v2) = $this->gameData[9];
        $min = 0;
        $max = 10;


        if (!($v1 >= $min && $v1 <= $max)) {

            $error = "Invalid Frame Data,  " . $v1;
            array_push($this->errorArray, $error);
            return;
        }
        if (!($v2 >= $min && $v2 <= $max)) {
            $error = "Invalid Frame Data,  " . $v2;
            array_push($this->errorArray, $error);
            return;
        }
        }
    }
}