<?php

  
require_once '../modules/simplehtmldom/simple_html_dom.php';
require_once '../modules/database/database.php';

$db = new Database();

$opts = array('http'=>array('method'=>"GET",'header'=>"Accept-language: en\r\n" ."User-Agent: not for you\r\n"));
$context = stream_context_create($opts);

$html = new simple_html_dom();

$html = file_get_html("https://www.coinexchange.io/api/v1/getorderbook?market_id=402", false, $context);

if($html->plaintext!='') {
    $json = $html->plaintext;
        $trades = json_decode($json, true);
        print '<pre>';
        print_r($trades);
        print '</pre>';
        $strades = $trades['result']['SellOrders'];
        $btrades = $trades['result']['BuyOrders'];
    
        foreach($strades as $trade){
            $text = $trade['Type'].' :: '.$trade['Price'].'BTC, quantity: '.$trade['Quantity'].'\n'.$trade['OrderTime'];
            print $text.'<br>';
            $db->saveHistory($trade);
        }
        foreach($btrades as $trade){
            $text = $trade['Type'].' :: '.$trade['Price'].'BTC, quantity: '.$trade['Quantity'].'\n'.$trade['OrderTime'];
            print $text.'<br>';
            $db->saveHistory($trade);
        }
        
        
    
}
else print "error parsing page";