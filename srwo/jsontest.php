<?php
	$conn = mysqli_connect("localhost","root","password","tangmo","3306");
	
	if (mysqli_connect_errno($con)){	
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}else{
		echo "success";
	}	
?>