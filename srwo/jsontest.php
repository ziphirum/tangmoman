<?php
	$conn = mysqli_connect("localhost","root","password", "tangmoman","3306");
	
	if (mysqli_connect_errno($conn)){	
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}else{
		echo "success";
	}	
?>