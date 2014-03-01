<?php 

	function sqlStr($str){
		return "'".$str."'" ;
	}

	function classToJson($class){
		$class_vars = get_class_vars(get_class($class));

		foreach ($class_vars as $name => $value) {
		    echo "$name : $value\n";
		}
	}
?>
