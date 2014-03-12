<?php
	
	include 'constants.php';

	function defenderList($userid){
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
			$user_vars[getClass] = get_class($user);
			$objs_vars[] = $user_vars;
			
			$char_vars = $char->getObjectVars();
			$char_vars[getClass] = get_class($char);
			$objs_vars[] = $char_vars;
			
			$arr_obj_vars[] = $objs_vars;
			
		}
		
		closeConn($conn);
		return json_encode($arr_obj_vars);
	}
	
	function classToJsonX(){
		$arr_obj_vars = array();
		$args = func_get_args();
		foreach ($args as $obj){
			$obj_vars = $obj->getObjectVars();
			$obj_vars[getClass] = get_class($obj);
			$arr_obj_vars[] = $obj_vars;
		}
		return json_encode($arr_obj_vars);
	}
?>