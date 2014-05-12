<?php

	include "database.php";
	include "common.php";
	include "class.php";
	include "session.php";
	
	$userid = $_GET["id"];
	$want = $_GET["want"];
	$p1 = $_GET["p1"];
	$p2 = $_GET["p2"];

	if(isEmpty($userid)){
		$userid = getLoginSession();
	}

	$conn = openConn();

	if (isEmpty($userid)){
		echo jsonError();
	} else{
		$char = new Character($userid);
		if ($want === "money") {
			money($char, $p1);
		}
	}

	function money($char, $amount) {
		$result = $char->increaseMoney($amount);
		if($result) {
			echo jsonOk();
		} else {
			echo jsonError();
		}
	}

?>