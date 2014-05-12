<?php

	include "database.php";
	include "common.php";
	include "class.php";
	include "session.php";
	
	$userid = $_GET["id"];
	$skillid = $_GET["skillid"];

	if(isEmpty($userid)){
		$userid = getLoginSession();
	}

	$conn = openConn();

	if (isEmpty($userid) || isEmpty(getLoginSession())){
		echo jsonError();
	} else{
		$char = new Character($userid);
		$result = $char->upgradeSkill($skillid);

		if($result) {
			echo jsonOk();
		} else {
			echo jsonError();
		}
	}

?>