<?php
	include 'database.php';
	include 'common.php';
<<<<<<< HEAD
	


=======
	include 'class.php';
	

>>>>>>> FETCH_HEAD
	function login($username) {
		$conn = openConn();
		$sql = "SELECT *  FROM tm_useraccount WHERE username= ".sqlStr($username);

		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result)){
			echo $row['id'] . " " .$row['username'] . " " . $row['name'];
			echo "<br>";
		}
<<<<<<< HEAD

		closeConn($conn);
	}

	$userLoggedOn = $_GET['username'];
	login($userLoggedOn);
=======
		closeConn($conn);
		return $row['id'];
	}

	$userLoggedOn = $_GET['username'];
	$userId = login($userLoggedOn);
	$user = new UserAccount($userId);

	echo $user->getName();
>>>>>>> FETCH_HEAD

?>