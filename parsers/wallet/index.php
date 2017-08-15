<?php

require_once '../modules/simplehtmldom/simple_html_dom.php';
require_once '../modules/database/database.php';

ini_set('max_execution_time', 100);
$db = new Database();

$opts = array('http'=>array('method'=>"GET",'header'=>"Accept-language: en\r\n" ."User-Agent: not for you\r\n"));
$context = stream_context_create($opts);

$html = new simple_html_dom();
$names = $db->showAll();
foreach($names as $name){
    $name = $name['name'];
    print '<br>'.$name.'<br>';
    $walletadr = $db->getWallet($name);
    $walletadr = $walletadr['wallet'];
    
    $wallet = 'https://etherscan.io/token/0x563383b56367ff2afffe5c6bcf9187bbe52d40ad?a='.$walletadr;

    $html = file_get_html($wallet, false, $context);
    if($html->plaintext!='') {
        $tr = $html->find('*[class=table] tbody tr');
        foreach($tr as $row){
            $coins = $row->plaintext;
            if (preg_match('/HUB/', $coins))   {
                preg_match('!\d+!', $coins, $hub);
                $balance = $hub[0];
                if ($walletadr == 'none') $balance = 0;
                print $name.": ".$balance." @ ".$walletadr;
                $db->saveBalance($walletadr, $balance);
            }
        }
    }
    else print "error parsing page"; 
}