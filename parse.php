<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="title" content="Главная страница сайта">
</head>
<body>
<?php 

function scrap($url)	{
	$curl = curl_init($url);

	curl_setopt($curl, CURLOPT_USERAGENT, "My User Agent Name");
	curl_setopt($curl, CURLOPT_FAILONERROR, true);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$html = curl_exec($curl);
	curl_close($curl);

	return $html;
}

$data=file_get_contents('http://hubcoin.io/ua.php');

$data = scrap('https://www.coinexchange.io/chat/undocked/');


print strlen($data);

die();

require_once 'simple_html_dom.php'; //подключили библиотеку

print "!1<br/>";

$page = file_get_html('https://www.coinexchange.io/chat/undocked/'); //скачали страничку
print "!2<br/>";


print strlen($page);

$t=$page->find('<div[class=chat-line]');

print "t $t";

die();

foreach($page->find('<div[class=chat-line]') as $div) {
	echo $div->innertext.'<br>';
}

print "!3";

?>
</body>
</html>