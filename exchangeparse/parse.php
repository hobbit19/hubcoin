<?php

  
require_once '../parser/modules/simplehtmldom/simple_html_dom.php';
$opts = array('http'=>array('method'=>"GET",'header'=>"Accept-language: en\r\n" ."User-Agent: not for you\r\n"));
$context = stream_context_create($opts);

$html = new simple_html_dom();

$html = file_get_html("https://www.coinexchange.io/market/HUB/BTC", false, $context);
echo 'hi?';
if($html->plaintext!='') {
    $divline = 'div[class=container-fluid] div[class=row] div[id=main-area] div[class=row] div[class=col-md-9] div[class=ico-details-box]';
    $divline .= ' div[class=panel-body] div[class=row] div table td';
    
    $div = $html->find($divline);
    foreach($div as $d){
    $ico = $d->plaintext;
    if (preg_match('/BTC/', $ico))   {print $ico.'<br>';
    file_put_contents('icofounds.txt', $ico);
    }
    }
}
        else print "error parsing page";
 