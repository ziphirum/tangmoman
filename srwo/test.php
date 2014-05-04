<?php
	
	include "class.php";
	include "constants.php";
	include "database.php";
	include "common.php";

	$b = new BattleLog();
	$b->setDetail("detail");
	$b->setTurn("1");
	$b->setAttackerId(1);
	$b->setDefenderId(2);
	// $b->insertLog();

	

?>