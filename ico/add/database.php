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
	
	
	
	public function addNew($options) 
    {
        $db = Database::Connect();
        $sql = 'INSERT INTO coins (name, description, date_launched, algo, forum, stage, website)'
                    .' VALUES (:name, :description,:date_launched, :algo, :forum, :stage, :website)';
        $result = $db->prepare($sql);
        $result->bindParam(':name',             $options['name'],         PDO::PARAM_STR);
        $result->bindParam(':description',      $options['description'],  PDO::PARAM_STR);
        $result->bindParam(':date_launched',    $options['datel'],        PDO::PARAM_STR);
        $result->bindParam(':algo',             $options['algo'],         PDO::PARAM_STR);
        $result->bindParam(':forum',            $options['forum'],        PDO::PARAM_STR);
        $result->bindParam(':stage',            $options['stage'],        PDO::PARAM_STR);
        $result->bindParam(':website',          $options['site'],         PDO::PARAM_STR);
        return $result->execute();
    }
	
    public function update($name, $descr, $start, $fin, $whpaper, $source, $ico, $forum, $code, $media)
    {
        
        $db = Database::Connect();
        $sql = "INSERT INTO ico (name, description, starting_date, finishing_date, whitepaper, source, ico_page, forum, code, media)
                VALUES             (:name,:description,:starting_date,:finishing_date,:whitepaper,:source,:ico_page,:forum, :code, :media)
        ON DUPLICATE KEY UPDATE
                    name = :name,
                    description = :description,
                    starting_date = :starting_date,
                    finishing_date = :finishing_date,
                    whitepaper = :whitepaper,
                    source = :source,
                    ico_page = :ico_page,
                    forum = :forum,
                    code = :code,
                    media = :media";
        
        $result = $db->prepare($sql);
        $result->bindParam(':name',          $name,     PDO::PARAM_STR);
        $result->bindParam(':description',   $descr,    PDO::PARAM_STR);
        $result->bindParam(':starting_date', $start,    PDO::PARAM_STR);
        $result->bindParam(':finishing_date',$fin,      PDO::PARAM_STR);
        $result->bindParam(':whitepaper',    $whpaper,  PDO::PARAM_STR);
        $result->bindParam(':source',        $source,   PDO::PARAM_STR);
        $result->bindParam(':ico_page',      $ico,      PDO::PARAM_STR);
        $result->bindParam(':forum',         $forum,    PDO::PARAM_STR);
        $result->bindParam(':code',          $code,     PDO::PARAM_STR);
        $result->bindParam(':media',         $media,    PDO::PARAM_STR);
     
        
        $result->execute();

        $newsql = 'UPDATE coinslist SET readed = "0" WHERE urly = :url';
        $secresult = $db->prepare($newsql);
        $secresult->bindParam(':url', $forum, PDO::PARAM_STR);
        return $secresult->execute();

    }
    // public function showUnredacted()
    // {
    //     $db = Database::Connect();
    //     $sql = "SELECT * FROM `coinslist` ORDER BY `UNIXTIME` DESC";
    //     $db->query("SET NAMES 'UTF8'");
	// 	$result = $db->query($sql);
	// 	$result->setFetchMode(PDO::FETCH_ASSOC);
    //     for($i=0; $row = $result->fetch(); $i++)
    //     {
    //         $result['id'] = $row['id']    
    //     }
	// return $output;
    // }
    public function coinslist(){
        $y = 0;

        $db = Database::Connect();
        $sql = "SELECT * FROM coinslist";
        $db->query("SET NAMES 'UTF8'");
		$result = $db->query($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);

        for($i=0; $row = $result->fetch(); $i++)
        {
            if(preg_match('/ICO/',$row['name'])) {
            $y +=1;
            }
        }
	return $y;
    }

        // TO DO
    public function showAll()
    { 
        $output = [];

        $db = Database::Connect();
        $sql = "SELECT * FROM ico ORDER BY balance DESC, listed_times DESC, finishing_date ASC";
        
        $db->query("SET NAMES 'UTF8'");
		$result = $db->query($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);

        for($i=0; $row = $result->fetch(); $i++)
        {
            $output[$i]['name']             = $row['name'];
            $output[$i]['id']               = $row['id'];
            $output[$i]['description']      = $row['description'];
            $output[$i]['starting_date']    = $row['starting_date'];
            $output[$i]['finishing_date']   = $row['finishing_date'];
            $output[$i]['whitepaper']       = $row['whitepaper'];
            $output[$i]['source']           = $row['source'];
            $output[$i]['ico_page']         = $row['ico_page'];
            $output[$i]['forum']            = $row['forum'];
            $output[$i]['media']            = $row['media'];
            $output[$i]['code']             = $row['code'];
            $output[$i]['listed_times']     = $row['listed_times'];
            $output[$i]['balance']             = $row['balance'];
            $output[$i]['wallet']     = $row['wallet'];
        }
	return $output;
    }

    public function showAllMain()
    { 
        $output = [];

        $db = Database::Connect();
        $sql = "SELECT * FROM ico ORDER BY listed_times DESC";
        
        $db->query("SET NAMES 'UTF8'");
		$result = $db->query($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);

        for($i=0; $row = $result->fetch(); $i++)
        {
            $output[$i]['name']             = $row['name'];
            $output[$i]['id']               = $row['id'];
            $output[$i]['description']      = $row['description'];
            $output[$i]['starting_date']    = $row['starting_date'];
            $output[$i]['finishing_date']   = $row['finishing_date'];
            $output[$i]['whitepaper']       = $row['whitepaper'];
            $output[$i]['source']           = $row['source'];
            $output[$i]['ico_page']         = $row['ico_page'];
            $output[$i]['forum']            = $row['forum'];
            $output[$i]['media']            = $row['media'];
            $output[$i]['code']             = $row['code'];
            $output[$i]['listed_times']     = $row['listed_times'];
        }
	return $output;
    }

    public function showTen()
    { 
        $output = [];

        $db = Database::Connect();
        $sql = "SELECT * FROM ico  ORDER BY `finishing_date` ASC";
        $db->query("SET NAMES 'UTF8'");
		$result = $db->query($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);

        for($i=0; $row = $result->fetch(); $i++)
        {
            $output[$i]['name']             = $row['name'];
            $output[$i]['id']               = $row['id'];
            $output[$i]['description']      = $row['description'];
            $output[$i]['starting_date']    = $row['starting_date'];
            $output[$i]['finishing_date']   = $row['finishing_date'];
            $output[$i]['whitepaper']       = $row['whitepaper'];
            $output[$i]['source']           = $row['source'];
            $output[$i]['ico_page']         = $row['ico_page'];
            $output[$i]['forum']            = $row['forum'];
            $output[$i]['media']            = $row['media'];
            $output[$i]['code']             = $row['code'];
        }
	return $output;
    }

    public function saveOld($input)
    {
        $db = Database::Connect();
        $sql = "INSERT IGNORE INTO finished_ico (name, description, starting_date, finishing_date, whitepaper, source, ico_page, forum, code, media)
                VALUES             (:name,:description,:starting_date,:finishing_date,:whitepaper,:source,:ico_page,:forum, :code, :media)
        ON DUPLICATE KEY UPDATE
                    name = :name,
                    description = :description,
                    starting_date = :starting_date,
                    finishing_date = :finishing_date,
                    whitepaper = :whitepaper,
                    source = :source,
                    ico_page = :ico_page,
                    forum = :forum,
                    code = :code,
                    media = :media";
        
        $result = $db->prepare($sql);
        $result->bindParam(':name',          $input['name'],             PDO::PARAM_STR);
        $result->bindParam(':description',   $input['description'],      PDO::PARAM_STR);
        $result->bindParam(':starting_date', $input['starting_date'],    PDO::PARAM_STR);
        $result->bindParam(':finishing_date',$input['finishing_date'],   PDO::PARAM_STR);
        $result->bindParam(':whitepaper',    $input['whitepaper'],       PDO::PARAM_STR);
        $result->bindParam(':source',        $input['source'],           PDO::PARAM_STR);
        $result->bindParam(':ico_page',      $input['ico_page'],         PDO::PARAM_STR);
        $result->bindParam(':forum',         $input['forum'],            PDO::PARAM_STR);
        $result->bindParam(':code',          $input['code'],             PDO::PARAM_STR);
        $result->bindParam(':media',         $input['media'],            PDO::PARAM_STR);
        $result->execute();
    }

    public function dumpOld()
    {
        $output = [];

        $db = Database::Connect();
        $sql = "SELECT * FROM finished_ico ORDER BY `finishing_date` ASC";
        $db->query("SET NAMES 'UTF8'");
		$result = $db->query($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);

        for($i=0; $row = $result->fetch(); $i++)
        {
            $output[$i]['name']             = $row['name'];
            $output[$i]['id']               = $row['id'];
            $output[$i]['description']      = $row['description'];
            $output[$i]['starting_date']    = $row['starting_date'];
            $output[$i]['finishing_date']   = $row['finishing_date'];
            $output[$i]['whitepaper']       = $row['whitepaper'];
            $output[$i]['source']           = $row['source'];
            $output[$i]['ico_page']         = $row['ico_page'];
            $output[$i]['forum']            = $row['forum'];
            $output[$i]['media']            = $row['media'];
            $output[$i]['code']             = $row['code'];
        }
	return $output;
    }

}