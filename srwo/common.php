<?php 

	function sqlStr($str){
		return "'".$str."'" ;
	}

<<<<<<< HEAD
	function classToJson($obj){
		$obj_vars = $obj.getObjectVars();

		foreach ($obj_vars as $name => $value) {
=======
	function classToJson($class){
		$class_vars = get_class_vars(get_class($class));
		echo 'Class:<br>';
		foreach ($class_vars as $name => $value) {
>>>>>>> FETCH_HEAD
		    echo "$name : $value\n";
		}
	}
?>
