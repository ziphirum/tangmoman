<?php
	
	$skillid = $_GET["skillid"];

	$userid = getLoginSession();

	$conn = openConn();

	if (isEmpty($userid)){
		echo jsonError(ERROR_NO_SESSION);
	}else{
		$char = new Character($userid);
		$result = $char->upgradeSkill($skillid);

		if($result) {
			echo jsonOk();
		} else {
			echo jsonError(ERROR_UPGRADE_SKILL);
		}
	}

?>