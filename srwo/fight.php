<?php
	
	include 'database.php';
	include 'class.php';


	
	$attacker = $_GET['attacker'];
	$defender = $_GET['defender'];

	function fight($attacker, $defender){
		// attacker -1 lose , 0 draw, 1 win
		// $resultMap = array(-1 => "LOST", 0 => "DRAW", 1 => "WIN");
		// $result = $resultArr[rand(-1,1)];

		// echo $result;

		$conn = openConn();
		// Check connection

		mysqli_query($conn,"INSERT INTO Persons (FirstName, LastName, Age)
		VALUES ('Peter', 'Griffin',35)");

		mysqli_query($conn,"INSERT INTO Persons (FirstName, LastName, Age) 
		VALUES ('Glenn', 'Quagmire',33)");

		mysqli_close($conn);

	}
	

	fight($attacker, $defender);

?>