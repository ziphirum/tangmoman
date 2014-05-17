<?php 

	function sqlStr($str){
		return "'".$str."'" ;
	}

	function jsonOk(){
		return json_encode(array("status" => "OK"));
	}

	function jsonError($err = array("",""), $msg = ""){
		return json_encode(array("status" => "ERROR", "code" => $err[0], "message" => $err[1], "additional" => $msg));
	}

	function isNotEmpty($str){
		return $str !== null && $str !== "";
	}

	function isEmpty($str){
		return !isNotEmpty($str);
	}
	
	function isEven($n){
		return $n%2==0;
	}
	
	function isOdd($n){
		return !isEven($n);
	}

	function classToJson($status,$a){
		$arr_obj_vars = array();
		$arr_obj_vars[status] = $status;
		$args = func_get_args();
		array_shift($args);
		foreach ($args as $obj){
			$obj_vars = $obj->getObjectVars();
			//$obj_vars[getClass] = get_class($obj);
			$arr_obj_vars[get_class($obj)] = $obj_vars;
		}
		return json_encode($arr_obj_vars);
	}
	
	function isPossible($n){
		$randNum = rand(0,99);
		return $randNum<$n;
	}
	
	function checkEnergy($obj,$amount){
		return ($obj->getEnergy())>=$amount;
	}
	

?>