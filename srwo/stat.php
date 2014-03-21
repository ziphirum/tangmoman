<?php

	include 'database.php';
	include 'common.php';
	include 'class.php';

	$username = $_GET['username'];
	$conn = openConn();
	$sql = "SELECT *  FROM tm_useraccount WHERE username= ".sqlStr($username);

	$result = mysqli_query($conn, $sql);
	$userId;
	while($row = mysqli_fetch_array($result)){
		$userId = $row['id'];
	}
	closeConn($conn);

	$user = new UserAccount($userId);
	$char = new Character($userId);

	echo classToJson($user, $char);

?>