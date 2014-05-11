<?php

	include "database.php";
	include "common.php";
	include "class.php";
	include "session.php";
	
	$userid = $_GET["id"];
	$skillid = $_GET["skill"];

	if(isEmpty($userid)){
		$userid = getLoginSession();
	}

	$conn = openConn();
	$sql = "SELECT *  FROM tm_useraccount WHERE id= ".sqlStr($userid);

	$result = mysqli_query($conn, $sql);
	$userId = "";
	while($row = mysqli_fetch_array($result)){
		$userId = $row['id'];
	}
	closeConn($conn);
	
	if (isEmpty($userId) || isEmpty(getLoginSession())){
		echo jsonError();
	} else{
		$char = new Character($userId);

		// echo classToJson("OK", $char);
		$skills = $char->getSkill();
		echo $skills[0]->getName();
	}

	/*
		Get Char
		Check upgrade skill id
		check money and turn
		UPDATE SQL


	*/

?>