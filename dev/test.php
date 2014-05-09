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

	echo date(DATE_FORMAT);

	$v = 5.2 * 3;

	if($v>15.6 AND $v<15.60000000001) {
	    echo 'We are doomed :S';
	    var_dump($v); // float 15.6
	} else {
	    echo 'Everything is fine =)';
	}

?>