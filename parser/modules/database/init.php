<?php

function mg_send($to, $subject, $message) 
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
        $confPath = 'db_conf.php';
        $conf=include($confPath);
        $dsn = "mysql:host={$conf['host']};dbname={$conf['dbName']}";
        $db = new PDO($dsn, $conf['user'], $conf['pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        
    	return $db;
    }
	
	
	
	public function SaveToBaseMent($line, $url)
	{
		$db = Database::Connect();
		$sql = "INSERT IGNORE INTO mentions (entries, fromwhere)"
                .' VALUES (:entries, :fromwhere)';
		$db->query("SET NAMES 'UTF8'");
		$result = $db->prepare($sql);
		$result->bindParam(':entries', $line, PDO::PARAM_STR);
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


	public function SaveToBase($container)
    {
        $db = Database::Connect();
        $sql = "INSERT IGNORE INTO coinslist (name, dob, urly)"
               ." VALUES (:name, :dob, :urly)";
        $db->query("SET NAMES 'UTF8'");
        $result = $db->prepare($sql);
        $result->bindParam(':name', $container['name'], PDO::PARAM_STR);
        $result->bindParam(':dob',  $container['dob'],  PDO::PARAM_STR);
        $result->bindParam(':urly', $container['link'], PDO::PARAM_STR);
        // print $sql;
        // die();
        $result->execute();
        return true;
    }

    public function Dump()
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
	return $output;
	}
	
}