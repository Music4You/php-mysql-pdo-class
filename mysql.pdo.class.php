<?php
/*
PDO MySQL Klasse
Florian Gerhardt
01.10.2014
*/
$MySQL['host'] = 'localhost';
$MySQL['user'] = 'root';
$MySQL['base'] = 'pdo';
$MySQL['pass'] = '';
$MySQL['char'] = 'utf8';

class MySQL 
{
	static protected $DB;
	static protected $Result;
	
	/*
		Connection to Database
		Params: Noting
		Returned: Keine
	*/
	public function __construct()
	{
		try 
		{
			global $MySQL;
			$this->DB = new PDO('mysql:host='.$MySQL['host'].';dbname='.$MySQL['base'].';charset='.$MySQL['char'].';', $MySQL['user'], $MySQL['pass']);
		}
		catch(PDOException $e) 
		{
			exit('Unable to connect Database.');
		}
	}
	
	/*
		Close the Connection
		Params: Noting
		Returned: Noting
	*/
	public function __destruct()
	{
		$this->DB = null;
	}
	
	/*
		Send a Query to Database
		Params: SQL Query
		Returned: The argument of the Query
	*/
	public function Query($query)
	{
		$type = strpos($query,'SELECT');
		if($type === false) 
		{
			$this->Result = $this->DB->exec($query);
		} 
		else 
		{
			$this->Result = $this->DB->query($query);
		}
		return $this->Reult;
	}
	
	/*
		Get the Count of Rows
		Params: SQL Query
		Returned: Count 
	*/
	public function RowCount($query)
	{
		if($query!==null)
			$this->Result = $this->DB->query($query);
		
		return $this->Result->rowCount();
	}
	
	/*
		Get the ID of the last Insert Row
		Params: Nothing
		Return: ID
	*/
	public function LastInsertID()
	{
		return $this->DB->lastInsertId();
	}
	
	/*
		"Escaped" any value
		Params: The escape Value
		Returned: Escaped Value
	*/
	public function Escape($param)
	{
		return mysql_real_escape_string($param);
	}
	
	/*
		Get Values
		Params: Query, or see the exampes
		Returned: An Array with the Values
	*/
	public function FetchObject($query)
	{
		if($query!==null)
			$this->Result = $query;

		$result = $this->Result->fetch();
		return $result;
	}
}
?>
