<?php
	
	$userId = getLoginSession();
	if(isEmpty($userId)){
		echo jsonError($ERROR["NO_SESSION"]);
	}else{
		$response = townList($userId);
		echo $response;
	}
	
	function townList($userid){
		$conn = openConn();
		$sql  = "select id ";
		$sql .= "from tm_useraccount ";
		$sql .= "where id<> ?";

		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $userid);
		$stmt->execute();
		$rs = $stmt->get_result();

		$arr_obj_vars = array();
		while($row = $rs->fetch_array()){
			$id = $row['id'];
			
			$user = new UserAccount($id);
			$char = new Character($id);
			
			$objs_vars = array();
			
			$user_vars = $user->getObjectVars();
			//$user_vars[getClass] = get_class($user);
			$objs_vars[get_class($user)] = $user_vars;
			
			$char_vars = $char->getObjectVars();
			//$char_vars[getClass] = get_class($char);
			$objs_vars[get_class($char)] = $char_vars;
			
			$arr_obj_vars[] = $objs_vars;
			
		}
		$arr_json_return = array();
		$arr_json_return[status] = "OK";
		$arr_json_return[TownList] = $arr_obj_vars;
		closeConn($conn);
		return json_encode($arr_json_return);
	}
	
?>