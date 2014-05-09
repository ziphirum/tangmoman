<?php
	
	include "database.php";
	include "class.php";
	include "common.php";
	include "constants.php";
	include "session.php";

	
	$attackerid = getLoginSession();
	$defenderid = intval($_GET["target"]);

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
			if($turn > MAX_TURN){
				$battleLog->setResult(DRAW);
				break;
			}
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
				$battleLog->setResult(WIN);
				$defender->setHp(0);
				break;
			}
			if($attacker->getHp()<=0){
				$battleLog->setResult(LOSE);
				$attacker->setHp(0);
				break;
			}
		}
		
		$battleLog->setTurn(intval($turn));
		$battleLog->setDetail($arr_detail);
		$battleLog->setTime(NOW);
		$battleLog->setAttackerMaxHp(intval($attacker->getMaxHp()));
		$battleLog->setDefenderMaxHp(intval($defender->getMaxHp()));
		$battleLog->setAttackerMaxSp(intval($attacker->getMaxSp()));
		$battleLog->setDefenderMaxSp(intval($defender->getMaxSp()));
		$battleLog->setAttackerHp(intval($attacker->getHp()));
		$battleLog->setAttackerSp(intval($attacker->getSp()));
		$battleLog->setDefenderHp(intval($defender->getHp()));
		$battleLog->setDefenderSp(intval($defender->getSp()));
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