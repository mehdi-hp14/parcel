<?php
class ModelBase
{
    public $db;

    public function __construct(){
		
		try {
			$this->db = new PDO("mysql:host=".$GLOBALS['Config']['db']['host'].";dbname=".$GLOBALS['Config']['db']['name'], $GLOBALS['Config']['db']['user'], $GLOBALS['Config']['db']['pass']);
			// set the PDO error mode to exception
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
			exit;
		}
    }
	
	public function GetRowsInArray($query, $params=array())
	{
		$sth = $this->db->prepare($query);
		if(is_array($params) AND count($params)>0){
			foreach($params as $k => $p){
				$sth->bindValue($k, $p);
			}
		}
		$sth->execute();
		
		$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		return $rows;
	}
	public function singleRow($query, $params=array())
	{
		try {
			$sth = $this->db->prepare($query);
			if(is_array($params) AND count($params)>0){
				foreach($params as $k => $p){
					$sth->bindValue($k, $p);
				}
			}
			
			$sth->execute();
			
			$row = $sth->fetch();
			
			return $row;
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
			exit;
		}
	}
	public function singleInsert($query, $params=array())
	{
		try {
			$sth = $this->db->prepare($query);
			if(is_array($params) AND count($params)>0){
				foreach($params as $k => $p){
					$sth->bindValue($k, $p);
				}
			}
			//print_r($sth->errorInfo());
			
			$sth->execute();
			
			$id = $this->db->lastInsertId();
			
			return $id;
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
			exit;
		}
	}
	public function ExecQuery($query, $params=array())
	{
		try {
			$sth = $this->db->prepare($query);
			if(is_array($params) AND count($params)>0){
				foreach($params as $k => $p){
					$sth->bindValue($k, $p);
				}
			}
			
			return $sth->execute();
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
			exit;
		}
	}
	
	public function dispose()
	{
		$this->db = null;
	}
}