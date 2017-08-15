<?php 

/*
	все настройки, типа логина или пароля от базы данных находятся в файле modules/database/db_conf.php и могут свободно меняться.
	Парсер расчитан на существующую sql таблицу parser с столбцом success.
	
	переменная $searchedWord - искомое в сообщении чата слово
			   $urls - страница для парсинга
			   
*/


define('ROOT', dirname(__FILE__));

$value = 0;

$urls = ['https://www.coinexchange.io/market/HUB/BTC', 'https://yobit.net/en/'];
$searchedWords = ['hub', 'coin', 't'];
$to = "example@mail.com"; // нужный емейл

require_once 'modules/simplehtmldom/simple_html_dom.php';
include 'modules/database/init.php';
		
$db = new Database();	

$opts = array('http'=>array('method'=>"GET",'header'=>"Accept-language: en\r\n" ."User-Agent: not for you\r\n"));
$context = stream_context_create($opts);

$html = new simple_html_dom();

foreach ($urls as $site) {
	//echo "<br><br>  parsing $site <br>";
	$html = file_get_html($site, false, $context);
	//print $html;
	if ($site == $urls[0]) 		$div = 'div[class=chat-line]';
	else if ($site == $urls[1]) $div = 'div[class=msgBox] div[class=atype0]'; 
	else $div = "div[id=chat-list] p";
	//echo $div."<br>";


	if($html->plaintext!='' and count($html->find($div))) {
		foreach($html->find($div) as $line) {
			$line = $line->plaintext;


			foreach($searchedWords as $word) {
               // print "~site !$site!, from !$urls[0]!";
				$regExp = "/".$word."/";
				if (preg_match($regExp,$line)) {   
					switch ($site) {
						case $urls[0]:
							$from = 'coinexchange';   
							break;
						case $urls[1]:
							$from = 'novaexchange';   
							break;
						case $urls[2]:
							$from = 'yobit';
							break;
					}
					//$out = $line."<br>";
					//print $out;
					$text = $line;  
					// print "!  text $text ;;;; from $from";   die();
					$db->SaveToBase($text, $from);
					// print $text;
				}
				else{
					// echo "line does not contains $word";
					// continue;
				}
			}
		}
	}

	$html->clear(); 
	unset($html);
}

$outputs = $db->ShowFromDb();
foreach ($outputs as $line) {
	echo "<b>".$line['date'].":</b>".$line['text'].'  ////  from: <b>'.$line['url'].'</b>';
	echo "<br/>";
}



die();