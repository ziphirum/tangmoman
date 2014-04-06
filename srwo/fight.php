<?php
	
	include "database.php";
	include "class.php";
	include "common.php";
	include "constants.php";
	include "session.php";

	
	$attackerid = getLoginSession();
	$defenderid = $_GET["target"];

	function fight($attackerid, $defenderid){

		$battleLog = new BattleLog();
		$battleLog->setAttackerId($attackerid);
		$battleLog->setDefenderId($defenderid);
		
		$attacker = new Character($attackerid);
		$defender = new Character($defenderid);

		$battleLog->setAttackerName($attacker->getName());
		$battleLog->setDefenderName($defender->getName());
		
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
		$battleLog->setTime(date(DATE_FORMAT));
		$battleLog->setAttackerHp($attacker->getHp());
		$battleLog->setAttackerSp($attacker->getSp());
		$battleLog->setDefenderHp($defender->getHp());
		$battleLog->setDefenderSp($defender->getSp());
		$battleLog->insertLog();

		return $battleLog;
	}
	
	if (isEmpty($attackerid) || isEmpty($defenderid) || $attackerid === $defenderid) {
		echo jsonError();
	} else {
		$battleLog = fight($attackerid,$defenderid);
		echo classToJson("OK", $battleLog);
	}

?>