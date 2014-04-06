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
		
		function __construct($userid){
			$conn = openConn();
			$sql  = "SELECT id,username,name ";
			$sql .= "from tm_useraccount ";
			$sql .= "where id=".$userid;
			
			$rs = mysqli_query($conn,$sql);

			while($row = mysqli_fetch_array($rs)){
				$this->setId($row['id']);
				$this->setUsername($row['username']);
				$this->setName($row['name']);
							
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
		

	}
	
	class Character extends TMClass{
		protected $id;
		protected $name;
		protected $hp;
		protected $sp;
		protected $maxHp;
		protected $maxSp;
		protected $characterDataName;
		protected $win;
		protected $lose;
		protected $draw;
		
		function __construct($userid){
			$conn = openConn();
			$sql  = "SELECT c.id,c.name,c.hp,c.sp,c.max_hp,c.max_sp,c.win,c.lose,c.draw,";
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

	class BattleLog extends TMClass{
		protected $id;
		protected $turn;
		protected $detail = array();
		protected $attackerId;
		protected $defenderId;
		protected $attackerName;
		protected $defenderName;
		protected $attackerHp;
		protected $defenderHp;
		protected $attackerSp;
		protected $defenderSp;
		protected $time;
		
		function __construct($getid = ""){
			if($getid == ""){
				$this->setId("");
			}else{
				$conn = openConn();

				$sql = "SELECT btl.id, btl.detail, btl.turn, btl.attacker_id, btl.defender_id, btl.time, ";
				$sql .= "btl.attacker_hp, btl.defender_hp, btl.attacker_sp, btl.defender_sp ";
				$sql .= "catk.name as attacker, cdef.name as defender ";
				$sql .= "FROM tm_battle_log btl ";
				$sql .= "left join tm_character catk on btl.attacker_id = catk.useraccount_id";
				$sql .= "left join tm_character cdef on btl.defender_id = cdef.useraccount_id";
				$sql .= "where id=" . $getId;
				
							
				$rs = mysqli_query($conn,$sql);
	
				while($row = mysqli_fetch_array($rs)){
					$this->setId($row['id']);
					$this->setName($row['name']);
					$this->setDetail(explode(NEW_LINE,$row['detail']));
					$this->setAttackerId($row['attacker_id']);
					$this->setDefenderId($row['defender_id']);
					$this->setTime($row['time']);
					$this->setAttackerName($row['attacker']);
					$this->setDefenderName($row['defender']);
					$this->setAttackerHp($row['attacker_hp']);
					$this->setDefenderHp($row['defender_hp']);
					$this->setAttackerSp($row['attacker_sp']);
					$this->setDefenderSp($row['defender_sp']);
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

		function setAttackerName($str){
			$this->attackerName = $str;
		}
		
		function getAttackerName(){
			return $this->attackerName;
		}
		
		function setDefenderName($str){
			$this->defenderName = $str;
		}
		
		function getDefenderName(){
			return $this->defenderName;
		}
		function setAttackerHp($str){
			$this->attackerHp = $str;
		}
		
		function getAttackerHp(){
			return $this->attackerHp;
		}
		
		function setDefenderHp($str){
			$this->defenderHp = $str;
		}
		
		function getDefenderHp(){
			return $this->defenderhp;
		}

		function setAttackerSp($str){
			$this->attackerSp = $str;
		}
		
		function getAttackerSp(){
			return $this->attackerSp;
		}
		
		function setDefenderSp($str){
			$this->defenderSp = $str;
		}
		
		function getDefenderSp(){
			return $this->defenderSp;
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
			$atkHp = $this->getAttackerHp();
			$defHp = $this->getDefenderHp();
			$atkSp = $this->getAttackerSp();
			$defSp = $this->getDefenderSp();
			$time = $this->getTime();

			$conn = openConn();
			$sql = "INSERT INTO tm_battle_log(detail, turn, attacker_id, defender_id, attacker_hp, defender_hp, time)";
			$sql .= "VALUES(" . sqlStr(implode(NEW_LINE,$detail)) .",".  sqlStr($turn) .",". sqlStr($atkId) .",". sqlStr($defId).",";
			$sql .= sqlStr($atkHp) .",". sqlStr($defHp) .",". sqlStr($atkSp) .",". sqlStr($defSp) .",". sqlStr($time) . ")";
			$rs = mysqli_query($conn, $sql);

			closeConn($conn);

		}
	}
?>