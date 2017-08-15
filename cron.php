<?php
file_put_contents('cron_log.txt', date("H:i:s"));

$time = date('i');
$delim = $time%5;

if($delim == 0){

file_get_contents('http://hubcoin.io/parser/index.php');
// die();
file_get_contents("http://hubcoin.io/coins/parser/index.php");
file_get_contents("http://hubcoin.io/dates/index.php");
file_get_contents("http://hubcoin.io/exchangeparse/parse.php");
file_get_contents("http://hubcoin.io/parsers/icos/nameparser/index.php");
file_get_contents("http://hubcoin.io/parsers/wallet/index.php");
file_get_contents("http://hubcoin.io/parsers/exchanges/parse.php");

if (!isset($token)) $token  = file_get_contents('cron_log_token.txt');

print 'Ok';
}
else print "five mins not over yet <br>"; print $time;