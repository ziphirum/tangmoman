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
				$skill = useSkill($attacker);
				$dmg = $skill->getDamage();
				$dmg = rand(intval($dmg*(1-DAMAGE_DEVIATION)),intval($dmg*(1+DAMAGE_DEVIATION)));
				$defender->setHp($defender->getHp()-$dmg);
				$detail = $attacker->getName()." attack with ".$skill->getName()." cause ".$dmg." damage ";
				$arr_detail[] = $detail;
			}else{
				$skill = useSkill($defender);
				$dmg = $skill->getDamage();
				$dmg = rand(intval($dmg*(1-DAMAGE_DEVIATION)),intval($dmg*(1+DAMAGE_DEVIATION)));
				$attacker->setHp($attacker->getHp()-$dmg);
				$detail = $defender->getName()." attack with ".$skill->getName()." cause ".$dmg." damage ";
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
	
	function useSkill(&$char){
		$nskill = chooseSkill($char);
		$skill = $char->getSkill();
		$spUsage = $skill[$nskill]->getSpUsage();
		$amount = $skill[$nskill]->getAmount();
		if(isNotEmpty($spUsage)){
			$char->setSp($char->getSp()-$spUsage);
		}
		if(isNotEmpty($amount)){
			$skill[$nskill]->setAmount($amount-1);
			$char->setSkill($skill);
		}
		return $skill[$nskill];
	}
	
	function chooseSkill($char){
		$sp = $char->getSp();
		$skill = $char->getSkill();
		$retval = count($skill)-1;
		for($i=0;$i<count($skill);$i++){
			$spUsage = $skill[$i]->getSpUsage();
			$amount = $skill[$i]->getAmount();		
			if((isNotEmpty($spUsage) && $sp<$spUsage) || (isNotEmpty($amount) && $amount==0)){
				continue;
			}else{
				$retval = $i;
				break;
			}
		}
		return $retval;
	}
	
	if (isEmpty($attackerid) || isEmpty($defenderid) || $attackerid === $defenderid) {
		echo jsonError();
	} else {
		$battleLog = fight($attackerid,$defenderid);
		echo classToJson("OK", $battleLog);
	}

?>