<?php
	
	$userid = $_GET["id"];
	if(isEmpty($userid)){
		$userid = getLoginSession();
	}
	$conn = openConn();
	$sql = "SELECT * FROM tm_useraccount WHERE id= ".sqlStr($userid);

	$result = mysqli_query($conn, $sql);
	$userId = "";
	while($row = mysqli_fetch_array($result)){
		$userId = $row['id'];
	}
	closeConn($conn);
	
	if(isEmpty($userId) || isEmpty(getLoginSession())){
		echo jsonError(ERROR_NO_SESSION);
	}else{
		$user = new UserAccount($userId);
		$char = new Character($userId);
		echo classToJson("OK", $user, $char);
	}
	

?>