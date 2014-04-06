<?php

	include "database.php";
	include "common.php";
	include "class.php";
	include "session.php";
	
	$userid = getLoginSession();
	$conn = openConn();
	$sql = "SELECT *  FROM tm_useraccount WHERE id= ".sqlStr($userid);

	$result = mysqli_query($conn, $sql);
	$userId = "";
	while($row = mysqli_fetch_array($result)){
		$userId = $row['id'];
	}
	closeConn($conn);
	
	if($userId == ""){
		$result = array ("status" => "ERROR");
		echo json_encode($result);
	}else{
		$user = new UserAccount($userId);
		$char = new Character($userId);
		echo classToJson($user, $char);
	}
	

?>