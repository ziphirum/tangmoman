<?php 

	function sqlStr($str){
		return "'".$str."'" ;
	}

	function classToJson(){
		$arr_obj_vars = array();
		$args = func_get_args();
		foreach ($args as $obj){
			$obj_vars = $obj->getObjectVars();
			//$obj_vars[getClass] = get_class($obj);
			$arr_obj_vars[get_class($obj)] = $obj_vars;
			$arr_obj_vars[Status] = "OK";
		}
		return json_encode($arr_obj_vars);
	}
?>
