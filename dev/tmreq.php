<?php
	
	include "constants.php";
	include "session.php";
	include "database.php";
	include "class.php";
	include "common.php";
	
	$tmi = $_GET["tmi"];
	
	if(isEmpty($tmi)){
		echo jsonError($ERROR["NO_TMI"]);
	}else if(isEmpty(getLoginSession()) && $tmi !== TMI_LOGIN){
		echo jsonError($ERROR["NO_SESSION"]);
	}else{
		Character::updateConnectionTime(getLoginSession());
		if($tmi === TMI_LOGIN){
			include "login.php";
		}else if($tmi === TMI_LOGOUT){
			include "logout.php";
		}else if($tmi === TMI_TOWN_LIST){
			include "town-list.php";
		}else if($tmi === TMI_STAT){
			include "stat.php";
		}else if($tmi === TMI_FIGHT){
			include "fight.php";
		}else if($tmi === TMI_UPGRADE_SKILL){
			include "upgrade-skill.php";
		}else{
			echo jsonError($ERROR["NOT_FOUND_TMI"]);
		}
	}
?>