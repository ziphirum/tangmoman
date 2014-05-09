<?php

	function openConn(){		
		$conn = mysqli_connect("localhost","root","password", "tangmoman","3306");
		return $conn;
	}

	function closeConn($conn){
		mysqli_close($conn);
	}

?>