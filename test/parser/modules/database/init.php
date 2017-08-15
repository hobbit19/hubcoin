<?php
class Database
{
    public function __construct()
    {
      $this->Connect();
    }
   
	public function Connect()
    {
        $confPath = 'db_conf.php';
        $conf=include($confPath);
        $dsn = "mysql:host={$conf['host']};dbname={$conf['dbName']}";
        $db = new PDO($dsn, $conf['user'], $conf['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        
    	return $db;
    }
	
	
	
	public function SaveToBase($line)
	{
		 $sql = 'INSERT INTO result (entries, url)'
                .' VALUES (:entries, :url)';
		$db->query("SET NAMES 'UTF8'");
		$result = $db->prepare($sql);
		$result->bindParam(':entries', $line, PDO::PARAM_STR);
		$result->bindParam(':url', $url, PDO::PARAM_STR);
		$result->execute();

		return true;
	}

	public function ShowFromDb()
	{
		$outputs = [];
	
		$sql = "SELECT * FROM result";
		$db->query("SET NAMES 'UTF8'");
		$result = $db->query($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);

		for($i=0; $row = $result->fetch(); $i++)
			{	
				$outputs[$i]['text'] = $row['entries'];
				$outputs[$i]['url'] = $row['url'];
			
			}
		return $outputs;
	}
	
}