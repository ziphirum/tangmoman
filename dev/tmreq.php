<?php
	
	include "constants.php";
	include "session.php";
	include "database.php";
	include "class.php";
	include "common.php";
	
	$tmi = $_GET["tmi"];
	
	if(isEmpty(getLoginSession()) && $tmi !== TMI_LOGIN){
		echo jsonError(ERROR_NO_SESSION);
	}else if($tmi === TMI_LOGIN){
		include "login.php";
	}else if($tmi === TMI_LOGOUT){
		include "logout.php";
	}else if($tmi === TMI_TOWN_LIST){
		include "town-list.php";
	}else if($tmi === TMI_STAT){
		include "stat.php";
	}else if($tmi === TMI_UPGRADE_SKILL){
		include "upgrade-skill.php";
	}else{
		echo jsonError(ERROR_NO_TMI);
	}
?>