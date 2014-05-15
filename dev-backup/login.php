<?php
	
	include "session.php";
	include "database.php";
	include "common.php";
	include "class.php";
	
	function login($username, $password) {
		$conn = openConn();
		$stmt = $conn->prepare("SELECT id FROM tm_useraccount WHERE username=? and password=?");
		$stmt->bind_param("ss", $username, $password);
		$stmt->execute();

		$stmt->store_result();
		$stmt->bind_result($uid);

		$result = array ("status" => "ERROR");
		while($stmt->fetch())
		{
		    if ($uid !== null && $uid !== ""){
		    	$result["status"] = "OK";
		    	createLoginSession($uid);
		    }
		}

		$stmt->close();
		closeConn($conn);
		return $result;
	}

	$username = $_GET["username"];
	$password = $_GET["password"];

	$result = login($username, $password);
	echo json_encode($result);
	
	// $user = new UserAccount($userId);
	// $char = new Character($userId);

	// echo classToJson($user, $char);
?>