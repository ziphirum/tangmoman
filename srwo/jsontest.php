<?php
	$conn = mysqli_connect("192.168.1.2","root","password","tangmo");
	
	if (mysqli_connect_errno($con)){	
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}else{
		echo "success";
	}	
?>