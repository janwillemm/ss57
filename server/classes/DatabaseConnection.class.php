<?php
class DatabaseConnection{

	private $PDO;

	public $DBNAME_FLITCIE = "flitcie_cache";
	public $DBNAME_QUOTES = "quotes";
	public $DBNAME_FACTS = "facts";
	public $DBNAME_SETTINGS = "settings";

	private static $instance;

	public static function getInstance(){
		if(!self::$instance){
			self::$instance = new DatabaseConnection();
		}
		return self::$instance;
	}

	function __construct(){
		if($_SERVER['SERVER_NAME'] == "tv.local"){
			$this->PDO = new PDO('mysql:host=localhost;dbname=bestuur_57_tv;charset=UTF-8', 'root', '75311536'); // Local server
		}
		else {
			$this->PDO = new PDO('mysql:host=localhost;dbname=bestuur_57_tv;charset=UTF-8', 'pccom', 'FILLINYOURPASSWORDHERE'); // Live server
		}
	}

	public function getter($dbnaam, $classenaam, $id){
 		$params = array(':id' => $id);
 		$stmt = $this->PDO->prepare("SELECT * FROM $dbnaam WHERE id=:id");
 		$stmt->execute($params);
 		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $classenaam); // NOTE: first fills propertys and then calls constructor?
 		$object = $stmt->fetch();
 		return $object;
	}

	public function deleter($dbnaam, $id){
 		$params = array(':id' => $id);
 		$stmt = $this->PDO->prepare("DELETE FROM $dbnaam WHERE id=:id");
 		return $stmt->execute($params);
	}

	public function getAll($dbnaam, $classname = false){
		$stmt = $this->PDO->prepare("SELECT * FROM $dbnaam;");
		$stmt->execute();
		if($classname)
			$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $classname); // NOTE: first fills propertys and then calls constructor?
 		return $stmt->fetchAll();
	}

	public function getImageUrlsForEventId($id){
		$stmt = $this->PDO->prepare("SELECT * FROM $this->DBNAME_FLITCIE WHERE event_id = :event_id");
		$stmt->execute(array(':event_id' => $id));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function setImageUrlsForEventId($imageUrls, $id){
		$this->deleteImageUrlsForEventId($id);

		$values = "";
		$params = array();
		foreach($imageUrls as $key => $imageUrl){
			$values .= " (NULL, :$key, $id, NOW()),";
			$params[":" . $key] = $imageUrl;
		}
		$values = rtrim($values, ",");
		$sql = "INSERT into $this->DBNAME_FLITCIE (id, url, event_id, date) VALUES $values";
		$stmt = $this->PDO->prepare($sql);
		$stmt->execute($params);

		return;
	}

	public function deleteImageUrlsForEventId($id){
		$params = array(':event_id' => $id);
		$stmt = $this->PDO->prepare("DELETE FROM $this->DBNAME_FLITCIE WHERE event_id = :event_id");
		$stmt->execute($params);
	}
}

?>