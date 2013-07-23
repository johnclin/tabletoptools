<?php

class DiceRoller {
    
    function execute(){
        switch($_GET['method']){
            case 'rollDice':
                $result = $this->rollDice($_GET['count'], $_GET['type'], $_GET['keep'], $_GET['open'], $_GET['times']);
				echo json_encode($result);
                break;
            case 'drawCard':
        }
    }
    
    function rollDice($dieCount, $dieType, $keep, $open, $rollCount){
        $result = array();
		$set = array();
        while (0 < $rollCount){
			$count = $dieCount;
			while (0 < $count){
				if($open){
					$result[] = $this->openRoll($open,$dieType);
				}else{
					$result[] = rand(1, $dieType);
				}
				$count--;
			}
			rsort($result);
			$resultSet['kept'] = array_slice($result,0,$keep);
			$resultSet['rolled'] = $result;
			$resultSet['sum'] = array_sum($resultSet['kept']);
			$set[] = $resultSet;
			unset($result);
			unset($resultSet);
			$rollCount--;
        }
        
        return $set;
    }
	
	function openRoll($open,$dieType){
		$roll = rand(1, $dieType);
		if ($roll >= $open){
			return $this->openRoll($open,$dieType) + $roll;
		}else{
			return $roll;
		}
	}
}

$DiceRoller = new DiceRoller();
$DiceRoller->execute();
?>
