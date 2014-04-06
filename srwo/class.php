<?php
	class TMClass{
	
		function getObjectVars(){
			return get_object_vars($this);
		}
	}
	
	class UserAccount extends TMClass{
		protected $id;
		protected $username;
		protected $name;
		protected $win;
		protected $lose;
		protected $draw;
		
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
		protected $id;
		protected $name;
		protected $hp;
		protected $sp;
		protected $maxHp;
		protected $maxSp;
		protected $characterDataName;
		
		function __construct($userid){
			$conn = openConn();
			$sql  = "SELECT c.id,c.name,c.hp,c.sp,c.max_hp,c.max_sp,";
			$sql .= "cd.name as character_data_name ";
			$sql .= "from tm_character c ";
			$sql .= "left join tm_character_data cd on cd.id = c.character_data_id ";
			$sql .= "where c.useraccount_id=".$userid;
						
			$rs = mysqli_query($conn,$sql);

			while($row = mysqli_fetch_array($rs)){
				$this->setId($row['id']);
				$this->setName($row['name']);
				$this->setHp($row['hp']);			
				$this->setSp($row['sp']);			
				$this->setMaxHp($row['max_hp']);			
				$this->setMaxSp($row['max_sp']);			
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
		
		function setHp($str){
			$this->hp = $str;
		}
		
		function getHp(){
			return $this->hp;
		}
		
		function setSp($str){
			$this->sp = $str;
		}
		
		function getSp(){
			return $this->hp;
		}
		
		function setMaxHp($str){
			$this->maxHp = $str;
		}
		
		function getMaxHp(){
			return $this->maxHp;
		}
		
		function setMaxSp($str){
			$this->maxSp = $str;
		}
		
		function getMaxSp(){
			return $this->maxSp;
		}
		
		function setCharacterDataName($str){
			$this->characterDataName = $str;
		}
		
		function getCharacterDataName(){
			return $this->characterDataName;
		}
		
	}

	class BattleLog extends TMClass{
		protected $id;
		protected $turn;
		protected $detail;
		protected $attackerId;
		protected $defenderId;
		protected $time;
		
		function __construct($getid = ""){
			if($getid == ""){
				$this->setId("");
			}else{
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
		}
		
		function setId($str){
			$this->id = $str;
		}
		
		function getId(){
			return $this->id;
		}
		
		function setTurn($str){
			$this->turn = $str;
		}
		
		function getTurn(){
			return $this->turn;
		}
		
		function setDetail($str){
			$this->detail = $str;
		}
		
		function getDetail(){
			return $this->detail;
		}
		
		function setAttackerId($str){
			$this->attackerId = $str;
		}
		
		function getAttackerId(){
			return $this->attackerId;
		}
		
		function setDefenderId($str){
			$this->defenderId = $str;
		}
		
		function getDefenderId(){
			return $this->defenderId;
		}
		
		function setTime($str){
			$this->time = $str;
		}
		
		function getTime(){
			return $this->time;
		}
		
		function insertLog(){
			$turn = $this->getTurn();
			$detail = $this->getDetail();
			$atkId = $this->getAttackerId();
			$defId = $this->getDefenderId();
			$time = date(DATE_FORMAT);

			$conn = openConn();
			$sql = "INSERT INTO tm_battle_log(detail, turn, attacker_id, defender_id, time)";
			$sql .= "VALUES(" . $detail .",".  $turn .",". $atkId .",". $defId .",". $time . ")";

			$rs = mysqli_query($conn, $sql);

			closeConn($con);

		}
	}
?>