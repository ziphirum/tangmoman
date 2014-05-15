<?php

	function openConn(){		
		$conn = mysqli_connect("localhost","root","password", "tangmoman","3306");
		return $conn;
	}

	function closeConn($conn){
		mysqli_close($conn);
	}


	function executeSQL($sql){
		$rs = FALSE;
		if ($sql !== FALSE){
			$conn = openConn();
			$rs = mysqli_query($conn, $sql);
			closeConn($conn);
		}
		return $rs;
	}
	
	function insertSQL($table,$insertArray){
		$retval = FALSE;
		$sql = "";		
		$col = "";
		$att = "";
		$sqlval = "";
		$aval = array();
		$aparam = array();
		foreach ($insertArray as $arr){
			$col .= $arr[0].",";
			$aval[] = $arr[1];
			$att .= $arr[2];
			$sqlval .= "?,";
		}
		
		$col = substr($col,0,-1);
		$sqlval = substr($sqlval,0,-1);
		$aparam[] = &$att;
 
		for($i=0;$i<count($aval);$i++) {
		  $aparam[] = &$aval[$i];
		}
		
		$sql = "INSERT INTO ".$table." (".$col.") VALUES(".$sqlval.")";
		
		$conn = openConn();
		$stmt = $conn->prepare($sql);
		call_user_func_array(array(&$stmt,"bind_param"), $aparam);
		if($stmt->execute()){
			$retval = TRUE;
		}
		closeConn($conn);
		return $retval;
		
	}

?>