<?php
	
	include "class.php";
	include "constants.php";
	include "database.php";
	include "common.php";

	// prepateStatement();
	updateStatement();
	// checkType();

	function checkType() {
		$data = array(1, 1., NULL, new stdClass, 'foo');
		foreach ($data as $value) {
		    echo gettype($value), "\n";
		}
	}

	function battleLog(){
		$b = new BattleLog();
		$b->setDetail("detail");
		$b->setTurn("1");
		$b->setAttackerId(1);
		$b->setDefenderId(2);
		// $b->insertLog();
	}

	function prepateStatement(){
		$conn = openConn();
		$stmt = $conn->prepare("SELECT id,username,password FROM tm_useraccount");
		// $username = "test";
		// $password = "test";
		// $stmt->bind_param("ss", $username, $password);
		$stmt->execute();

		$stmt->store_result();
		$stmt->bind_result($i, $u, $p);

		$result = array ("status" => "ERROR");
		while($stmt->fetch())
		{
			echo $i . $u . $p;
		}

		$stmt->close();
		closeConn($conn);
	}

	function updateStatement(){
		$conn = openConn();
		$sql = "UPDATE tm_char_skill SET upgrade_count = upgrade_count + 1 ";
		$sql .= "WHERE character_id = ? and skill_id = ?";
		$stmt = $conn->prepare($sql);
		$cid = 2;
		$sid = 2;
		$stmt->bind_param("ii", $cid, $sid);
		$rs = $stmt->execute();
		echo $rs;
		// $stmt->store_result();
		// $stmt->bind_result($i, $u, $p);

		// $result = array ("status" => "ERROR");
		// while($stmt->fetch())
		// {
		// 	echo $i . $u . $p;
		// }

		$stmt->close();
		closeConn($conn);
	}


?>