<?php
class Database
{

	public $sql;

    public function __construct()
    {
      $this->Connect();
    }
   
	public static function Connect()
    {
        $confPath = 'db_conf.php';
        $conf=include($confPath);
        $dsn = "mysql:host={$conf['host']};dbname={$conf['dbName']}";
        $db = new PDO($dsn, $conf['user'], $conf['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        
    	return $db;
    }
	
	
	
	public function SaveToBase($line, $url)
	{
		$db = Database::Connect();
		$sql = "INSERT IGONRE DUPLICATES INTO mentions (entries, fromwhere)"
                .' VALUES (:entries, :fromwhere)';
		$db->query("SET NAMES 'UTF8'");
		$result = $db->prepare($sql);
		$result->bindParam(':entries', $line, PDO::PARAM_STR);
		$result->bindParam(':fromwhere', $url, PDO::PARAM_STR);
		$result->execute();

		return true;
	}

	public function ShowFromDb()
	{
		$outputs = [];
		$db = Database::Connect();
		$sql = "SELECT * FROM mentions";
		$db->query("SET NAMES 'UTF8'");
		$result = $db->query($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);

		for($i=0; $row = $result->fetch(); $i++)
			{	
				$outputs[$i]['text'] = $row['entries'];
				$outputs[$i]['url'] = $row['fromwhere'];
				$outputs[$i]['date'] = $row['date_added'];
			
			}
		return $outputs;
	}
	
}