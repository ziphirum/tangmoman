<?php 

	function sqlStr($str){
		return "'".$str."'" ;
	}

	function isNotEmpty($str){
		return $str !== null && $str !== "";
	}

	function isEmpty($str){
		return $str == null || $str == "";
	}

	function classToJson($status,$a){
		$arr_obj_vars = array();
		$arr_obj_vars[Status] = $status;
		$args = func_get_args();
		array_shift($args);
		foreach ($args as $obj){
			$obj_vars = $obj->getObjectVars();
			//$obj_vars[getClass] = get_class($obj);
			$arr_obj_vars[get_class($obj)] = $obj_vars;
		}
		return json_encode($arr_obj_vars);
	}

?>