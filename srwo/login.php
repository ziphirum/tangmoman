<?php
	include 'database.php';
	include 'common.php';
	include 'class.php';
	

	function login($username) {
		$conn = openConn();
		$stmt = $conn->prepare("SELECT 1 FROM tm_useraccount WHERE username=?");
		$stmt->bind_param('s', $username);
		$stmt->execute();

		$stmt->store_result();
		$stmt->bind_result($column);

		$result = array ("status" => "ERROR");
		while($stmt->fetch())
		{
		    if ($column === 1){
		    	$result["status"] = "OK";
		    }
		}

    	// echo json_encode($result);
    	
		$stmt->close();
		closeConn($conn);

		// ##########################################################################

		// $conn = openConn();
		// $sql = "SELECT *  FROM tm_useraccount WHERE username= ".sqlStr($username);

		// $result = mysqli_query($conn, $sql);
		// $userId;
		// while($row = mysqli_fetch_array($result)){
		// 	$userId = $row['id'];
		// }
		// closeConn($conn);
		return $userId;
	}

	$username = $_GET['username'];
	$userId = login($username);
	$user = new UserAccount($userId);
	$char = new Character($userId);

	echo classToJson($user, $char);
?>