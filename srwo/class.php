<?php
	class UserAccount(){
		private $id;
		private $username;
		private $name;
		private $win;
		private $lose;
		private $draw;
		private $charId;
		private $townId;
		
		function __construct(){
			setId("");
			setUsername("");
			setName("");
			setWin("");
			setLose("");
			setDraw("");
			setCharId("");
			setTownId("");	
		}
		
		function __construct($userid){
			$conn = dbConnection();
			$cmd  = "SELECT id,username,name,win,lose,draw,char_id,town_id ";
			$cmd .= "from tm_useraccount ";
			$cmd .= "where id=".$usreid;
			
			$rs = mysqli_query($con,"SELECT * FROM Persons");

			while($row = mysqli_fetch_array($rs)){
				setId($row['id']);
				setUsername($row['username']);
				setName($row['name']);
				setWin($row['win']);
				setLose($row['lose']);
				setDraw($row['draw']);
				setCharId($row['char_id']);
				setTownId($row['town_id']);			
			}

			closeConnection($conn);
		}
		
		function setId($str){
			$this->$id = $str;
		}
		
		function getId(){
			return $this->$id;
		}
		
		function setUsername($str){
			$this->$username = $str;
		}
		
		function getUsername(){
			return $this->$username;
		}
		
		function setName($str){
			$this->$name = $str;
		}
		
		function getName(){
			return $this->$name;
		}
		
		function setWin($str){
			$this->$win = $str;
		}
		
		function getWin(){
			return $this->$win;
		}
		
		function setLose($str){
			$this->$lose = $str;
		}
		
		function getLose(){
			return $this->$lose;
		}
		
		function setDraw($str){
			$this->$draw = $str;
		}
		
		function getDraw(){
			return $this->$draw;
		}
		
		function setCharId($str){
			$this->$charId = $str;
		}
		
		function getCharId(){
			return $this->$charId;
		}
		
		function setTownId($str){
			$this->$townId = $str;
		}
		
		function getTownId(){
			return $this->$townId;
		}
	}
?>