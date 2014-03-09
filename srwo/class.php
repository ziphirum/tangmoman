<?php
	class TMClass{
	
		function getObjectVars(){
			return get_object_vars($this);
		}
	}
	
	class UserAccount extends TMClass{
		private $id;
		private $username;
		private $name;
		private $win;
		private $lose;
		private $draw;
		
		function __construct($userid){
			$conn = openConn();
			$sql  = "SELECT id,username,name,win,lose,draw ";
			$sql .= "from tm_useraccount ";
			$sql .= "where id=".$userid;
			
			$rs = mysqli_query($conn,$sql);

			while($row = mysqli_fetch_array($rs)){
				$this->setId($row['id']);
				$this->setUsername($row['username']);
				$this->setName($row['name']);
				$this->setWin($row['win']);
				$this->setLose($row['lose']);
				$this->setDraw($row['draw']);			
			}

			closeConn($conn);
		}
				
		function setId($str){
			$this->id = $str;
		}
		
		function getId(){
			return $this->id;
		}
		
		function setUsername($str){
			$this->username = $str;
		}
		
		function getUsername(){
			return $this->username;
		}
		
		function setName($str){
			$this->name = $str;
		}
		
		function getName(){
			return $this->name;
		}
		
		function setWin($str){
			$this->win = $str;
		}
		
		function getWin(){
			return $this->win;
		}
		
		function setLose($str){
			$this->lose = $str;
		}
		
		function getLose(){
			return $this->lose;
		}
		
		function setDraw($str){
			$this->draw = $str;
		}
		
		function getDraw(){
			return $this->draw;
		}

	}
	
	class Character extends TMClass{
		private $id;
		private $name;
		private $characterDataName;
		
		function __construct($userid){
			$conn = openConn();
			$sql  = "SELECT c.id,c.name,";
			$sql .= "cd.name as character_data_name ";
			$sql .= "from tm_character c ";
			$sql .= "left join tm_character_data cd on cd.id = c.character_data_id ";
			$sql .= "where c.useraccount_id=".$userid;
						
			$rs = mysqli_query($conn,$sql);

			while($row = mysqli_fetch_array($rs)){
				$this->setId($row['id']);
				$this->setName($row['name']);
				$this->setCharacterDataName($row['character_data_name']);			
			}

			closeConn($conn);
		}
		
		function setId($str){
			$this->id = $str;
		}
		
		function getId(){
			return $this->id;
		}
		
		function setName($str){
			$this->name = $str;
		}
		
		function getName(){
			return $this->name;
		}
		
		function setCharacterDataName($str){
			$this->characterDataName = $str;
		}
		
		function getCharacterDataName(){
			return $this->characterDataName;
		}
		
	}
?>