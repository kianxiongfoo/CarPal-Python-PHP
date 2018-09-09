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

    if(isset($this->errorArray)){
        echo $this->errorArray[0];
        unset($this->errorArray);
        exit;
    }
    else {
        echo 'has no error';
    }
}
private function validateInput(){
    if(sizeof($this->gameData) != 10) {
        $error = "Invalid Game Data, Expecting 10 Frames, ".sizeof($this->gameData) ." Frames given!";
       array_push($this->errorArray,$error);
        return;
    }
    //Validate Total and Faulty Data
    for($i = 0 ; $i <= sizeof($this->gameData)-1; $i++) {
        $tmparr = $this->gameData[$i];
        if (sizeof($tmparr) == 2) {
            if (!filter_var($tmparr[0], FILTER_VALIDATE_INT, array('options' => array('min_range' => 0, 'max_range' => 10)))) {
                $error = "Invalid Frame Data,  " . $tmparr[0];
                array_push($this->errorArray, $error);
                return;
            }
            if (!filter_var($tmparr[1], FILTER_VALIDATE_INT, array('options' => array('min_range' => 0, 'max_range' => 10)))) {
                $error = "Invalid Frame Data,  " . $tmparr[1];
                array_push($this->errorArray, $error);
                return;
            }

        } elseif (sizeof($tmparr) == 1) {
            if ($tmparr[0] !== 10) {
                $error = "Invalid Frame Data,  " . $tmparr[0];
                array_push($this->errorArray, $error);
                return;
            }

            //var_dump($this->gameData[$i]);
        }
    }
}
}