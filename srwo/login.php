<?php
	include 'database.php';
	include 'common.php';
	include 'class.php';
	

	function login($username) {
		$conn = openConn();
		$sql = "SELECT *  FROM tm_useraccount WHERE username= ".sqlStr($username);

		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result)){
			echo $row['id'] . " " .$row['username'] . " " . $row['name'];
			echo "<br>";
		}
		closeConn($conn);
		return $row['id'];
	}

	$userLoggedOn = $_GET['username'];
	$userId = login($userLoggedOn);
	$user = new UserAccount($userId);

	echo $user->getName();

?>