<?php 

/*
	все настройки, типа логина или пароля от базы данных находятся в файле modules/database/db_conf.php и могут свободно меняться.
	Парсер расчитан на существующую sql таблицу parser с столбцом success.
	
	переменная $searchedWord - искомое в сообщении чата слово
			   $url - страница для парсинга
			   
	парсер(сейчас) работает только для парса чата на данном в тестовом задании сайте.
*/


$urls = ['https://www.coinexchange.io/market/HUB/BTC', 'second', 'third'];
$searchedWords = ['hub', 'hubcoin'];
$to = "example@mail.com"; // нужный емейл

require_once 'modules/simplehtmldom/simple_html_dom.php';
require_once 'modules/database/init.php';
require_once 'modules/mailer/mail.php';
		
$db = new Database();	
$mailer = new Mailer();


$opts = array('http'=>array('method'=>"GET",'header'=>"Accept-language: en\r\n" ."User-Agent: not for you\r\n"));
$context = stream_context_create($opts);

$html = new simple_html_dom();

foreach ($url as $site) {
	$html = file_get_html($site, false, $context);


	if($html->innertext!='' and count($html->find('div[class=chat-line]'))) {
		foreach($html->find('div[class=chat-line]') as $line) {
			foreach($searchedWords as $word) {
				$regExp = "/".$word."/";
				if (preg_match($regExp,$line)) {
					$text = $line->plaintext." /// from ".$site;  print $text;
					$subject = "новое упоминание о hubcoin";
					$db->SaveToBase($text);
					$mailer->mg_send($to, $subject, $text);
				}
				else{
					 echo "line does not contains $word";
				}
			}
		}
	}

	$html->clear(); 
	unset($html);
}

$outputs = $db->ShowFromDb();
foreach ($outputs as $line) {
	echo $line['text'].'from: <b>'.$line['url'].'</b>';
	echo "<br/>";
}

die();