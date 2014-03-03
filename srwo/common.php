<?php 

	function sqlStr($str){
		return "'".$str."'" ;
	}

	function classToJson($obj){
		$obj_vars = $obj.getObjectVars();

		foreach ($obj_vars as $name => $value) {
		    echo "$name : $value\n";
		}
	}
?>
