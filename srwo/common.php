<?php 

	function sqlStr($str){
		return "'".$str."'" ;
	}

	function classToJson($obj){
		$obj_vars = $obj->getObjectVars();

		echo json_encode($obj_vars);
	}
?>
