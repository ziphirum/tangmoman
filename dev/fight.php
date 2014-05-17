<?php

	$attackerid = getLoginSession();
	$defenderid = intval($_GET["target"]);
	
	if (isEmpty($attackerid) || isEmpty($defenderid) || $attackerid === $defenderid) {
		if(isEmpty($attackerid)){
			echo jsonError($ERROR["NO_SESSION"]);
		}elseif(isEmpty($defenderid)){
			echo jsonError($ERROR["FIGHT"], "No Enemy Selected");
		}elseif($attackerid === $defenderid){
			echo jsonError($ERROR["FIGHT"], "Cannot Attack Yourself");
		}else{
			echo jsonError($ERROR["FIGHT"]);
		}		
	} else {
		$battleLog = fight($attackerid,$defenderid);
		echo classToJson("OK", $battleLog);
	}

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
		$attacking = array();
		while(true){
			$turn++;
			if($turn > MAX_TURN){
				$battleLog->setResult(DRAW);
				break;
			}
			if(isOdd($turn)){
				$fightDetail = skillAttack($attacker);
				$defender->setHp($defender->getHp()-$fightDetail[0]);		
				$arr_detail[] = $fightDetail[1];
			}else{
				$fightDetail = skillAttack($defender);
				$attacker->setHp($attacker->getHp()-$fightDetail[0]);		
				$arr_detail[] = $fightDetail[1];
			}
			
			if($defender->getHp()<=0){
				$battleLog->setResult(WIN);
				break;
			}
			if($attacker->getHp()<=0){
				$battleLog->setResult(LOSE);
				break;
			}
		}
		
		$result = $battleLog->getResult();
		if($result === WIN){
			$defender->setHp(0);
			$attacker->updateFight(WIN);
			$defender->updateFight(LOSE);
		}elseif($result === LOSE){
			$attacker->setHp(0);
			$attacker->updateFight(LOSE);
			$defender->updateFight(WIN);
		}elseif($result === DRAW){
			$attacker->updateFight(DRAW);
			$defender->updateFight(DRAW);
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
	
	function skillAttack(&$char){
		$skill = useSkill($char);
		$dmg = $skill->getDamage();
		$dmg = rand(intval($dmg*(1-DAMAGE_DEVIATION)),intval($dmg*(1+DAMAGE_DEVIATION)));
		
		$criticalRate = $skill->getCritical();
		$criticalDamage = $char->getCritical();
		if(isPossible($skill->getCritical())){
			$dmg += $dmg * rand(intval($criticalDamage/2),$criticalDamage)/100;
			$dmg  = intval($dmg);
			$detail = $char->getName()." attack with ".$skill->getName()." cause ".$dmg." critical damage ";
		}else{
			$detail = $char->getName()." attack with ".$skill->getName()." cause ".$dmg." damage ";	
		}		
		return array($dmg,$detail);
	}
		

?>