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


?>