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
			$sql .= "where id=?";
			
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('i',$userid);
			$stmt->execute();
			$rs = $stmt->get_result();
			
			while($row = $rs->fetch_assoc()){
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
		protected $defense;
		protected $accuracy;
		protected $evasion;
		protected $critical;		
		protected $characterDataName;
		protected $win;
		protected $lose;
		protected $draw;
		protected $money;
		protected $energy;
		protected $lastConnectionTime;
		protected $skill = array();
		
		function __construct($userid){
			$conn = openConn();
			$sql  = "SELECT c.id,c.name,c.hp,c.sp,c.max_hp,c.max_sp,c.win,c.lose,c.draw,c.money,c.energy, ";
			$sql .= "c.defense,c.accuracy,c.evasion,c.critical,";
			$sql .= "cd.name as character_data_name,c.last_connection_time ";
			$sql .= "from tm_character c ";
			$sql .= "left join tm_character_data cd on cd.id = c.character_data_id ";
			$sql .= "where c.useraccount_id=?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('i',$userid);
			$stmt->execute();
			$rs = $stmt->get_result();
			
			while($row = $rs->fetch_assoc()){
				$this->setId($row['id']);
				$this->setName($row['name']);
				$this->setHp($row['hp']);			
				$this->setSp($row['sp']);			
				$this->setMaxHp($row['max_hp']);			
				$this->setMaxSp($row['max_sp']);			
				$this->setDefense($row['defense']);			
				$this->setAccuracy($row['accuracy']);			
				$this->setEvasion($row['evasion']);			
				$this->setCritical($row['critical']);			
				$this->setCharacterDataName($row['character_data_name']);	
				$this->setWin($row['win']);
				$this->setLose($row['lose']);
				$this->setDraw($row['draw']);
				$this->setMoney($row['money']);
				$this->setEnergy($row['energy']);
				$this->setLastConnectionTime($row['last_connection_time']);
			}
			
			$stmt->close();
			
			$sql  = "SELECT s.id,sd.damage+(sd.upgrade_damage*s.upgrade_count) as damage ";
			$sql .= "from tm_char_skill s ";
			$sql .= "left join tm_skill_data sd on sd.id=s.skill_id ";
			$sql .= "where s.character_id=? ";
			$sql .= "order by damage desc ";
			$stmt = $conn->prepare($sql);
			$charId = $this->getId();
			$stmt->bind_param('i',$charId);
			$stmt->execute();
			$rs = $stmt->get_result();
	
			$askill = array();
			while($row = $rs->fetch_assoc()){			
				$askill[] = new Skill($row['id']);		
			}
			$this->setSkill($askill);
			
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
			return $this->sp;
		}
		
		function setDefense($str){
			$this->defense = $str;
		}
		
		function getDefense(){
			return $this->defense;
		}
		
		function setAccuracy($str){
			$this->accuracy = $str;
		}
		
		function getAccuracy(){
			return $this->accuracy;
		}
		
		function setEvasion($str){
			$this->evasion = $str;
		}
		
		function getEvasion(){
			return $this->evasion;
		}
		
		function setCritical($str){
			$this->critical = $str;
		}
		
		function getCritical(){
			return $this->critical;
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
		
		function setSkill($str){
			$this->skill = $str;
		}
		
		function getSkill(){
			return $this->skill;
		}

		function setEnergy($str){
			$this->energy = $str;
		}
		
		function getEnergy(){
			return $this->energy;
		}

		function setMoney($str){
			$this->money = $str;
		}
		
		function getMoney(){
			return $this->money;
		}
		
		function setLastConnectionTime($str){
			$this->lastConnectionTime = $str;
		}
		
		function getLastConnectionTime(){
			return $this->lastConnectionTime;
		}

		function updateFight($status){
			$sql = "";
			$retval = FALSE;
			if ($status === WIN) {
				$sql = "UPDATE tm_character SET win = win+1 WHERE id = ?";
			} elseif ($status === DRAW) {
				$sql = "UPDATE tm_character SET draw = draw+1 WHERE id = ?";
			}  elseif ($status === LOSE) {
				$sql = "UPDATE tm_character SET lose = lose+1 WHERE id = ?";
			}

			if ($sql !== "") {
				$conn = openConn();
				$stmt = $conn->prepare($sql);
				$charId = $this->getId();
				$stmt->bind_param('i',$charId);
				if($stmt->execute()){
					$retval = TRUE;
				}
				closeConn($conn);
			}
			return $rs;
		}

		function upgradeSkill($skillId){
			$skillList = $this->getSkill();
			$skillListLength = count($skillList);
			$retval = FALSE;
			$skillSQL = "";
			for ($i=0; $i < $skillListLength; $i++) {
				// Validate selected skill id
				if ($skillId === $skillList[$i]->getId()) {
					// decrease money
					$upgradeCost = ($skillList[$i]->getUpgradeCount() + 1) * $skillList[$i]->getUpgradeMoney();
					$rs = $this->decreaseMoney($upgradeCost);
					if ($rs) {
						// Update skill
						$skillSQL = "UPDATE tm_char_skill SET damage = damage+? ";
						$skillSQL .= " , upgrade_count = upgrade_count + 1 ";
						$skillSQL .= "WHERE id = ?";
						$stmt = $conn->prepare($skillSQL);
						$upgradeDamage = $skillList[$i]->getUpgradeDamage();
						$stmt->bind_param('ii',$upgradeDamage,$skillId);
						if($stmt->execute()){
							$retval = TRUE;
						}
					}
					break;
				}
			}
			return $retval;
		}

		function decreaseMoney($amount){
			$moneySQL = "";
			$retval = FALSE;
			if ($this->getMoney() >= $amount) {
				$moneySQL = "UPDATE tm_character SET money = money - ? ";
				$moneySQL .= " WHERE id = ?";
			}
			if ($moneySQL !== ""){
				$conn = openConn();
				$stmt = $conn->prepare($moneySQL);
				$charId = $this->getId();
				$stmt->bind_param('ii',$amount,$charId);
				if($stmt->execute()){
					$retval = TRUE;
				}
				closeConn($conn);
			}

			return $retval;
		}

		function increaseMoney($amount){
			$moneySQL = "";
			$retval = FALSE;
			
			$moneySQL = "UPDATE tm_character SET money = money + ? ";
			$moneySQL .= " WHERE id = ?";
			
			if ($moneySQL !== ""){
				$conn = openConn();
				$stmt = $conn->prepare($moneySQL);
				$charId = $this->getId();
				$stmt->bind_param('ii',$amount,$charId);
				if($stmt->execute()){
					$retval = TRUE;
				}
				closeConn($conn);
			}

			return $retval;
		}
		
		function decreaseEnergy($amount){
			$energySQL = "";
			$retval = FALSE;
			if ($this->getEnergy() >= $amount) {
				$energySQL = "UPDATE tm_character SET energy = energy - ? ";
				$energySQL .= " WHERE id = ?";
				echo $energySQL;
			}
			if ($energySQL !== ""){
				$conn = openConn();
				$stmt = $conn->prepare($energySQL);
				$charId = $this->getId();
				$stmt->bind_param('ii',$amount,$charId);
				if($stmt->execute()){
					$retval = TRUE;
				}
				closeConn($conn);
			}

			return $retval;
		}

		function increaseEnergy($amount){
			$energySQL = "";
			$retval = FALSE;
			
			$energySQL = "UPDATE tm_character SET energy = energy + ? ";
			$energySQL .= " WHERE id = ?";
			
			if ($energySQL !== ""){
				$conn = openConn();
				$stmt = $conn->prepare($energySQL);
				$charId = $this->getId();
				$stmt->bind_param('ii',$amount,$charId);
				if($stmt->execute()){
					$retval = TRUE;
				}
				closeConn($conn);
			}

			return $retval;
		}
		
		public static function updateConnectionTime($userid = ""){
			$updConnSQL = "";
			$sql = "";
			$retval = FALSE;
			
			if (isNotEmpty($userid)) {
				$conn = openConn();
				$sql  = "select TIMESTAMPDIFF(MINUTE,last_connection_time, NOW()), energy ";
				$sql .= "from tm_character ";
				$sql .= "where useraccount_id=? ";
				$stmt1 = $conn->prepare($sql);
				$stmt1->bind_param('i',$userid);
				$stmt1->execute();
				$stmt1->bind_result($minute,$energy);
				$stmt1->fetch();
				
				$addEnergy += intval($minute/MINUTE_PER_ENERGY);
				$addTime = $addEnergy*MINUTE_PER_ENERGY;
				
				$stmt1->close();
								
				$energy += $addEnergy;
				$energy  = min($energy,MAX_ENERGY);
				
				$updConnSQL = "UPDATE tm_character SET ";
				$updConnSQL .= "last_connection_time = TIMESTAMPADD(MINUTE,?,last_connection_time), energy = ? ";
				$updConnSQL .= " WHERE id = ?";
			
				$stmt2 = $conn->prepare($updConnSQL);
				$stmt2->bind_param('iii',$addTime,$energy,$userid);
				if($stmt2->execute()){
					$retval = TRUE;
				}
				closeConn($conn);
			}

			return $retval;
		}
		
		function getObjectVars(){
			$obj_vars = get_object_vars($this);
			for($i=0;$i<count($obj_vars["skill"]);$i++){
				$obj_vars["skill"][$i] = $obj_vars["skill"][$i]->getObjectVars();
			}
			return $obj_vars;
		}

		
	}

	class BattleLog extends TMClass{
		protected $id;
		protected $turn;
		protected $result;
		protected $detail = array();
		protected $attackerId;
		protected $defenderId;
		protected $attackerName;
		protected $defenderName;
		protected $attackerHp;
		protected $defenderHp;
		protected $attackerSp;
		protected $defenderSp;
		protected $attackerMaxHp;
		protected $defenderMaxHp;
		protected $attackerMaxSp;
		protected $defenderMaxSp;
		protected $time;
		
		function __construct($getid = ""){
			if($getid == ""){
				$this->setId("");
			}else{
				$conn = openConn();

				$sql = "SELECT btl.id, btl.detail, btl.turn, btl.attacker_id, btl.defender_id, btl.time,btl.result, ";
				$sql .= "btl.attacker_hp, btl.defender_hp, btl.attacker_sp, btl.defender_sp, ";
				$sql .= "btl.attacker_max_hp, btl.defender_max_hp, btl.attacker_max_sp, btl.defender_max_sp, ";
				$sql .= "catk.name as attacker, cdef.name as defender ";
				$sql .= "FROM tm_battle_log btl ";
				$sql .= "left join tm_character catk on btl.attacker_id = catk.useraccount_id";
				$sql .= "left join tm_character cdef on btl.defender_id = cdef.useraccount_id";
				$sql .= "where id=?";
										
				$stmt = $conn->prepare($sql);
				$stmt->bind_param('i',$getid);
				$stmt->execute();
				$rs = $stmt->get_result();
				
				while($row = $rs->fetch_assoc()){
					$this->setId($row['id']);
					$this->setName($row['name']);
					$this->setDetail(explode(NEW_LINE,$row['detail']));
					$this->setAttackerId($row['attacker_id']);
					$this->setDefenderId($row['defender_id']);
					$this->setTime($row['time']);
					$this->setResult($row['result']);
					$this->setAttackerName($row['attacker']);
					$this->setDefenderName($row['defender']);
					$this->setAttackerHp($row['attacker_hp']);
					$this->setDefenderHp($row['defender_hp']);
					$this->setAttackerSp($row['attacker_sp']);
					$this->setDefenderSp($row['defender_sp']);
					$this->setAttackerMaxHp($row['attacker_max_hp']);
					$this->setDefenderMaxHp($row['defender_max_hp']);
					$this->setAttackerMaxSp($row['attacker_max_sp']);
					$this->setDefenderMaxSp($row['defender_max_sp']);
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
		
		function setResult($str){
			$this->result = $str;
		}
		
		function getResult(){
			return $this->result;
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
			return $this->defenderHp;
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
		
		function setAttackerMaxHp($str){
			$this->attackerMaxHp = $str;
		}
		
		function getAttackerMaxHp(){
			return $this->attackerMaxHp;
		}
		
		function setDefenderMaxHp($str){
			$this->defenderMaxHp = $str;
		}
		
		function getDefenderMaxHp(){
			return $this->defenderMaxHp;
		}

		function setAttackerMaxSp($str){
			$this->attackerMaxSp = $str;
		}
		
		function getAttackerMaxSp(){
			return $this->attackerMaxSp;
		}
		
		function setDefenderMaxSp($str){
			$this->defenderMaxSp = $str;
		}
		
		function getDefenderMaxSp(){
			return $this->defenderMaxSp;
		}
		
		function setTime($str){
			$this->time = $str;
		}
		
		function getTime(){
			return $this->time;
		}
		
		function insertLog(){
			$turn = $this->getTurn();
			$result = $this->getResult();
			$detail = $this->getDetail();
			$atkId = $this->getAttackerId();
			$defId = $this->getDefenderId();
			$atkHp = $this->getAttackerHp();
			$defHp = $this->getDefenderHp();
			$atkSp = $this->getAttackerSp();
			$defSp = $this->getDefenderSp();
			$atkMaxHp = $this->getAttackerMaxHp();
			$defMaxHp = $this->getDefenderMaxHp();
			$atkMaxSp = $this->getAttackerMaxSp();
			$defMaxSp = $this->getDefenderMaxSp();
			$time = $this->getTime();

			
			$table = "tm_battle_log";
			$insertArray = array(
								array("detail",implode(NEW_LINE,$detail),"s"),
								array("turn",$turn,"i"),
								array("result",$result,"i"),
								array("attacker_id",$atkId,"i"),
								array("defender_id",$defId,"i"),
								array("attacker_hp",$atkHp,"i"),
								array("defender_hp",$defHp,"i"),
								array("attacker_sp",$atkSp,"i"),
								array("defender_sp",$defSp,"i"),
								array("attacker_max_hp",$atkMaxHp,"i"),
								array("defender_max_hp",$defMaxHp,"i"),
								array("attacker_max_sp",$atkMaxSp,"i"),
								array("defender_max_sp",$defMaxSp,"i"),
								array("time",$time,"s"),
								);
			
			$retval = insertSQL($table,$insertArray);
			return $retval;

		}
	}
	
	class Skill extends TMClass{
		protected $id;
		protected $name;
		protected $baseDamage;
		protected $damage;
		protected $accuracy;
		protected $critical;
		protected $amount;
		protected $spUsage;
		protected $upgradeDamage;
		protected $upgradeMoney;
		protected $upgradeCount;
		
		function __construct($sid){
			$conn = openConn();
			$sql  = "SELECT s.id,sd.name,sd.damage as basedamage,sd.accuracy,sd.critical,sd.amount,sd.sp_usage,";
			$sql .= "sd.upgrade_damage,sd.upgrade_money,s.upgrade_count ";
			$sql .= "from tm_char_skill s ";
			$sql .= "left join tm_skill_data sd on sd.id=s.skill_id ";
			$sql .= "where s.id=?";

			$stmt = $conn->prepare($sql);
			$stmt->bind_param('i',$sid);
			$stmt->execute();
			$rs = $stmt->get_result();
			
			while($row = $rs->fetch_assoc()){
				$this->setId($row['id']);
				$this->setName($row['name']);
				$this->setBaseDamage($row['basedamage']);
				$this->setAccuracy($row['accuracy']);
				$this->setCritical($row['critical']);
				$this->setSpUsage($row['sp_usage']);
				$this->setUpgradeDamage($row['upgrade_damage']);
				$this->setUpgradeMoney($row['upgrade_money']);
				$this->setUpgradeCount($row['upgrade_count']);	
				
				$this->setDamage($this->getBaseDamage()+($this->getUpgradeDamage()*$this->getUpgradeCount()));					
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
		
		function setBaseDamage($str){
			$this->damage = $str;
		}
		
		function getBaseDamage(){
			return $this->baseDamage;
		}
		
		function setDamage($str){
			$this->baseDamage = $str;
		}
		
		function getDamage(){
			return $this->damage;
		}
		
		function setAccuracy($str){
			$this->accuracy = $str;
		}
		
		function getAccuracy(){
			return $this->accuracy;
		}
		
		function setCritical($str){
			$this->critical = $str;
		}
		
		function getCritical(){
			return $this->critical;
		}
		
		function setAmount($str){
			$this->amount = $str;
		}
		
		function getAmount(){
			return $this->amount;
		}
		
		function setSpUsage($str){
			$this->spUsage = $str;
		}
		
		function getSpUsage(){
			return $this->spUsage;
		}
		
		function setUpgradeDamage($str){
			$this->upgradeDamage = $str;
		}
		
		function getUpgradeDamage(){
			return $this->upgradeDamage;
		}
		
		function setUpgradeMoney($str){
			$this->upgradeMoney = $str;
		}
		
		function getUpgradeMoney(){
			return $this->upgradeMoney;
		}
		
		function setUpgradeCount($str){
			$this->upgradeCount = $str;
		}
		
		function getUpgradeCount(){
			return $this->upgradeCount;
		}
	}
?>