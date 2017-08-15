<?php 

/*
	��� ���������, ���� ������ ��� ������ �� ���� ������ ��������� � ����� modules/database/db_conf.php � ����� �������� ��������.
	������ �������� �� ������������ sql ������� parser � �������� success.
	
	���������� $searchedWord - ������� � ��������� ���� �����
			   $url - �������� ��� ��������
			   
	������(������) �������� ������ ��� ����� ���� �� ������ � �������� ������� �����.
*/


$url = 'https://www.coinexchange.io/market/HUB/BTC';
$searchedWord = 'honey';


$lookFor = "/".$searchedWord."/";

require_once 'modules/simplehtmldom/simple_html_dom.php';
require_once 'modules/database/init.php';
		
$db = new Database();	
$opts = array('http'=>array('method'=>"GET",'header'=>"Accept-language: en\r\n" ."User-Agent: not for you\r\n"));
$context = stream_context_create($opts);

$html = new simple_html_dom();

$html = file_get_html($url, false, $context);


if($html->innertext!='' and count($html->find('div[class=chat-line]'))) {
 foreach($html->find('div[class=chat-line]') as $line) {
  if (preg_match($lookFor,$line)) {
	  $text = $line->plaintext;
	  $db->SaveToBase($text);
  }
//	 else echo "line does not contains this words";
 }
}

$html->clear(); 
unset($html);


$outputs = $db->ShowFromDb();
foreach ($outputs as $line => $value) {
	print_r($value);
	echo "<br/>";
}
