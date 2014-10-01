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
		Verbindung zur Datenbank
		Parameter: Keine
		Return: Keine
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
		Schließen der Verbindung
		Parameter: Keine
		Return: Keine
	*/
	public function __destruct()
	{
		$this->DB = null;
	}
	
	/*
		Schickt einen Query an die Datenbank
		Parameter: Den SQL Query
		Return: Das ergebniss des Querys
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
		Gibt die Anzahl der Datensätze wieder
		Parameter: Den SELECT Query
		Return: Anzahl der Datensätze
	*/
	public function RowCount($query)
	{
		if($query!==null)
			$this->Result = $this->DB->query($query);
		
		return $this->Result->rowCount();
	}
	
	/*
		Gibt die ID des letzten eingetragenen Datensatzes aus
		Parameter: Keine
		Return: ID des letzten Datensatzes
	*/
	public function LastInsertID()
	{
		return $this->DB->lastInsertId();
	}
	
	/*
		"Escaped" einen Wert 
		Parameter: Den zu escapenden wert
		Return: Escapter Wert
	*/
	public function Escape($param)
	{
		//Sollte es eine einfache Methode in PDO geben, um nur Einen wert zu escapen, lasst es mich wissen.
		return mysql_real_escape_string($param);
	}
	
	/*
		Holt einen Wert aus der Datenbank
		Parameter: Query, SELECT * .. !
		Return: einen Array, Werte sind als Feldnamen gespeichert, siehe Beispiel
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
