<?php
	
	date_default_timezone_set('UTC');

	define("SES_UID","tm_ses_uid");

	define("WIN", 1);
	define("LOSE", -1);
	define("DRAW", 0);

	define("DATE_FORMAT", "Y-m-d H:i:s");
	define("NOW", date(DATE_FORMAT));
	
	define("NEW_LINE", chr(13));
	
	define("MAX_TURN", 999);

	define("DAMAGE_DEVIATION", 0.1);
	
	define("MINUTE_PER_ENERGY",2);
	define("MAX_ENERGY",50);
	// TMI ACTION
	define("TMI_LOGIN", "login");
	define("TMI_LOGOUT", "logout");
	define("TMI_TOWN_LIST", "town-list");
	define("TMI_STAT", "stat");
	define("TMI_UPGRADE_SKILL", "upgrade-skill");
		
	// JSON ERROR
	// define("ERROR_NO_SESSION", array(1,"No Session, Need to login"));
	// define("ERROR_NO_TMI", array(2,"No Action to Perform"));
	// define("ERROR_FIGHT", array(3,"Error when Attacking"));
	// define("ERROR_UPGRADE_SKILL", array(4,"Error when Upgrading Skill"));
	
	// Constant Cannot be array
	static $ERROR = array(
		"NO_SESSION" => array(1,"No Session, Need to login"),
		"NO_TMI" => array(2,"No Action to Perform"),
		"NOT_FOUND_TMI" => array(3,"Action not found"),
		"FIGHT" => array(4,"No Error when Attacking"),
		"ERROR_UPGRADE_SKILL" => array(5,"Error when Upgrading Skill")
	);
	

?>