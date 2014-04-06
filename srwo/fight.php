<?php
	
	include "database.php";
	include "class.php";
	include "common.php";
	include "constants.php";

	
	$attackerid = $_GET["attacker"];
	$defenderid = $_GET["defender"];

	function fight($attackerid, $defenderid){
		// attacker -1 lose , 0 draw, 1 win
		// $resultMap = array(-1 => "LOST", 0 => "DRAW", 1 => "WIN");
		// $result = $resultArr[rand(-1,1)];

		// echo $result;
		$battleLog = new BattleLog();
		$battleLog->setAttackerId($attackerid);
		$battleLog->setDefenderId($defenderid);
		
		$attacker = new Character($attackerid);
		$defender = new Character($defenderid);
		
		$arr_detail = array();
		$turn = 0;
		
		while(true){
			$turn++;
			if(isOdd($turn)){
				$dmg = rand(100,500);
				$defender->setHp($defender->getHp()-$dmg);
				$detail = $attacker->getName()." attack with ".$dmg." damage ";
				$arr_detail[] = $detail;
			}else{
				$dmg = rand(100,500);
				$attacker->setHp($attacker->getHp()-$dmg);
				$detail = $defender->getName()." attack with ".$dmg." damage ";
				$arr_detail[] = $detail;
			}
			
			if($defender->getHp()<=0){
				$defender->setHp(0);
				break;
			}
			if($defender->getHp()<=0){
				$defender->setHp(0);
				break;
			}
		}
		
		$battleLog->setTurn($turn);
		$battleLog->setDetail($arr_detail);
		
		$battleLog->insertLog();
	}
	
	fight($attackerid,$defenderid);

?>