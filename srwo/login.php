<?php
	include 'database.php';
	include 'common.php';
	include 'class.php';
	

	function login($username) {
		$conn = openConn();
		$sql = "SELECT *  FROM tm_useraccount WHERE username= ".sqlStr($username);

		$result = mysqli_query($conn, $sql);
		$userId;
		while($row = mysqli_fetch_array($result)){
			$userId = $row['id'];
		}
		closeConn($conn);
		return $userId;
	}

	$userLoggedOn = $_GET['username'];
	$userId = login($userLoggedOn);
	//echo $userId;
	//echo "<br>";
	$user = new UserAccount($userId);
	$char = new Character($userId);

	echo classToJson($user);
	// echo "<br>";
	// echo $user->getName();
	// echo "<br>";
	// echo $char->getCharacterDataName();

?>