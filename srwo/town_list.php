<?php
	
	include 'database.php';
	include 'class.php';

	function townList($userid){
		$conn = openConn();
		$sql  = "select id ";
		$sql .= "from tm_useraccount ";
		$sql .= "where id<>".$userid;
		
		$result = mysqli_query($conn,$sql);
		$arr_obj_vars = array();
		while($row = mysqli_fetch_array($result)){
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
		$arr_json_return[TownList] = $arr_obj_vars;
		$arr_json_return[Status] = "OK";
		closeConn($conn);
		return json_encode($arr_json_return);
	}
	
	$userId = $_GET['id'];
	$response = townList($userId);
	echo $response;
?>