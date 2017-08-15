<?php


    function mg_send($to, $subject, $message) // отправка емейла
      {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, 'api:'.'key-9e45b4f77e6254e3d8de5c852541d542');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $plain = strip_tags(nl2br($message));

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/sandboxa3c9cd9daa924c39a31827f1e23423ba.mailgun.org/messages');
            curl_setopt($ch, CURLOPT_POSTFIELDS, array('from' => 'support@sandboxa3c9cd9daa924c39a31827f1e23423ba.mailgun.org',
                  'to' => $to,
                  'subject' => $subject,
                  'html' => $message,
                  'text' => $plain));

            $j = json_decode(curl_exec($ch));

            $info = curl_getinfo($ch);

            print_r($info);
            
            if($info['http_code'] != 200)
                  die('Error!');

            curl_close($ch);

            return $j;
      }

class Database
{

	public $sql;

    public function __construct()
    {
      $this->Connect();
    }
   
	public static function Connect()
    {
        $confPath = 'conf.php';
        $conf=include($confPath);
        $dsn = "mysql:host={$conf['host']};dbname={$conf['dbName']}";
        $db = new PDO($dsn, $conf['user'], $conf['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        
    	return $db;
    }
	
	
	public function dumpCoins() // выводит список нередактированных монеток
    {
        $output = [];
        $db = Database::Connect();
        $sql = "SELECT * FROM coins";
        $db->query("SET NAMES 'UTF8'");
		$result = $db->query($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);

        for($i=0; $row = $result->fetch(); $i++)
        {
            $output[$i]['id']             = $row['id'];
            $output[$i]['name']           = $row['name'];
            $output[$i]['description']    = $row['description'];
            $output[$i]['date_launched']  = $row['date_launched'];
            $output[$i]['algo']           = $row['algo'];
            $output[$i]['forum']          = $row['forum'];
            $output[$i]['website']        = $row['website'];
            
        }
        return $output;

    }

    	public function addNew($options)  // добавляет новую монетку из нередактированного списка
    {
        $db = Database::Connect();
        $sql = 'INSERT IGNORE INTO coins (name, description, date_launched, algo, forum, website)'
                    .' VALUES (   :name,:description,:date_launched,:algo,:forum,:website)';
        $result = $db->prepare($sql);
        $result->bindParam(':name',          $options['name'],           PDO::PARAM_STR);
        $result->bindParam(':description',   $options['description'],    PDO::PARAM_STR);
        $result->bindParam(':date_launched', $options['datel'],          PDO::PARAM_STR);
        $result->bindParam(':algo',          $options['algo'],           PDO::PARAM_STR);
        $result->bindParam(':forum',         $options['forum'],          PDO::PARAM_STR);
        $result->bindParam(':website',       $options['site'],           PDO::PARAM_STR);
        return $result->execute();
    }

    public function article($opt)  // добавляет новую монетку из нередактированного списка
    {
        $db = Database::Connect();
        $sql = 'INSERT IGNORE INTO news (title, text, add_file)'
                    .' VALUES (:title, :text, :add_file)';
        $result = $db->prepare($sql);
        $result->bindParam(':title',      $opt['title'],               PDO::PARAM_STR);
        $result->bindParam(':text',       $opt['text'],                PDO::PARAM_STR);
        $result->bindParam(':add_file',   $opt['add_file'],            PDO::PARAM_STR);
        $result->execute();
        $id = $db->lastInsertId();
        return $id;
    }

       public function enlist($url)
    {   
        $url = preg_replace('/\s+/', '', $url);
        $db = Database::Connect();
        $sql = 'UPDATE coinslist SET enlisted = "1" WHERE urly like :urly';
        $result = $db->prepare($sql);
        $result->bindParam(':urly', $url, PDO::PARAM_STR);
        
        return $result->execute();
    }
	
    public function update($name, $descr, $start, $fin, $whpaper, $source, $ico, $forum, $code, $media)
    { // добавляет ико из нередактированных в список /ico, если запись уже есть - обновляет ее
        
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
    // TO DO
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

    public function coinslist(){ // считает количество выведенных ико на странице /ico
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

    public function showAll() // выводит список всех ико
    { 
        $output = [];

        $db = Database::Connect();
        $sql = "SELECT * FROM ico ORDER BY `finishing_date` ASC";
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
    public function saveBalance($wallet, $balance)
    {
        $db = Database::Connect();
        $sql = "UPDATE ico SET balance = :balance WHERE wallet like :wallet";
        $result = $db->prepare($sql);
        $result->bindParam(':wallet', $wallet, PDO::PARAM_STR);
        $result->bindParam('balance', $balance, PDO::PARAM_STR);
        return $result->execute();
    }

    public function getWallet($name)
    {
        $db = Database::Connect();
        $sql = "SELECT wallet FROM ico WHERE name like '".$name."'";
        $db->query("SET NAMES 'UTF8'");
        $result = $db->query($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);
        $output = $result->fetch();
        return $output;
    }
    public function enlistme($name, $i)
    {
        $db = Database::Connect();
        $sql = "UPDATE ico SET listed_times = :i WHERE name like :name";
        $result = $db->prepare($sql);
        $result->bindParam(':i', $i, PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        return $result->execute();
    }

    public function saveHistory($container)
    {
        $db = Database::Connect();
        $sql = "INSERT IGNORE INTO markHist (type, quan, price, ordtime)"
                                ." VALUES (:type, :quan,:price,:ordtime)";
        $db->query("SET NAMES 'UTF8'");
        $result = $db->prepare($sql);
        $result->bindParam(':type',      $container['Type'],     PDO::PARAM_STR);
        $result->bindParam(':quan',      $container['Quantity'],     PDO::PARAM_STR);
        $result->bindParam(':price',     $container['Price'],    PDO::PARAM_STR);
        $result->bindParam(':ordtime',   $container['OrderTime'],  PDO::PARAM_STR);
        $result->execute();
        return true;
    }

    public function saveOld($input) // сохраняет старую запись в другую таблицу 
    {                               // и делает ее невидимой в списке нередактированных
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

    public function dumpOld() // выводит список всех старых ико
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


       public function SaveToBase($container) // добавляет монетку в список нередактированных
    { 
        $db = Database::Connect();
        $sql = "INSERT IGNORE INTO coinslist (name, dob, url)"
               ." VALUES (:name, :dob, :url)";
        $db->query("SET NAMES 'UTF8'");
        $result = $db->prepare($sql);
        $result->bindParam(':name', $container['name'], PDO::PARAM_STR);
        $result->bindParam(':dob',  $container['dob'],  PDO::PARAM_STR);
        $result->bindParam(':url',  $container['url'],  PDO::PARAM_STR);
        $result->execute();
        return true;
    }

    public function Dump() // выводит список нередактированных монет
    {
        $output = [];

        $db = Database::Connect();
        $sql = "SELECT * FROM coinslist";
        $db->query("SET NAMES 'UTF8'");
		$result = $db->query($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);

        for($i=0; $row = $result->fetch(); $i++)
        {
            $output[$i]['name'] = $row['name'];
            $output[$i]['dob']  = $row['dob'];
            $output[$i]['url']  = $row['url'];
        }
    }



	public function SaveToBaseMent($line, $url) // добавляет в базу упоминания в чате
	{
		$db = Database::Connect();
		$sql = "INSERT IGNORE INTO mentions (entries, fromwhere)"
                .' VALUES (:entries, :fromwhere)';
		$db->query("SET NAMES 'UTF8'");
		$result = $db->prepare($sql);
		$result->bindParam(':entries',   $line,PDO::PARAM_STR);
		$result->bindParam(':fromwhere', $url, PDO::PARAM_STR);
		$result->execute();
		$count = $result->rowCount();
		if ($count != 0 ) {
				$subject = "new mention about hubcoin";
				$text = $line;
				$to = 'zombocraft7@gmail.com';

				$dd=date("H:i:s");
				$f=fopen('mail_log.txt', 'a');
				fwrite($f, "$to, $subject, $text; $dd\n");

				mg_send($to, $subject, $text);
		}


		return true;
	}

	public function ShowFromDb() // показывает упоминания из бд
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
				$outputs[$i]['url']  = $row['fromwhere'];
				$outputs[$i]['date'] = $row['date_added'];
			
			}
		return $outputs;
	}

}