<?php


if (!isset($token)) $token = file_get_contents("../../cron_log_token.txt");


$url = 'https://bitcointalk.org/index.php?board=159.0'; // .$token; for parsing all

require_once 'modules/simplehtmldom/simple_html_dom.php';
require_once '../../parser/modules/database/init.php';
$db = new Database();

$opts = array('http'=>array('method'=>"GET",'header'=>"Accept-language: en\r\n" ."User-Agent: not for you\r\n"));
$context = stream_context_create($opts);

$html = new simple_html_dom();

$html = file_get_html($url, false, $context);


$x = 0; // keys for pages container

$contexts = ['tr td[class=windowbg] span a']; // ? <- 'tr td[class=windowbg3] span a'


$links = [];
$storedDates = [];

if($html->innertext!='' and count($html->find('tr'))) {                
    foreach($contexts as $tag) {
    $links = findThread($tag, $links, $html);
        }
    $storedDates = takeDate($links, $storedDates);
   // foreach($html->find('a[class=navPages]') as $page) {

   // }
}


for($i = 0; $i<=count($storedDates); $i++){
    $db->SaveToBase($storedDates[$i]);
    print "<pre>";
    print_r($storedDates);
    print "</pre>";
}

// $token += 40;


// file_put_contents("../../cron_log_token.txt", $token);


function takeDate($linksArray, $container)
    { 
        foreach($linksArray as $link){
            
            $ind = count($container);
            $opts    = array('http'=>array('method'=>"GET",'header'=>"Accept-language: en\r\n" ."User-Agent: not for you\r\n"));
            $context = stream_context_create($opts);
            $html    = new simple_html_dom();
            $html    = file_get_html($link, false, $context);
            
            foreach($html->find('td[id=top_subject]') as $string){
                $name = $string->plaintext;
            }
            
            $cases = ['span[class=edited]', 'td[class=td_headerandpost] div[class=smalltext]'];
            foreach($cases as $case){
                foreach($html->find($case) as $date){
                    $text = $date->plaintext;       // print $text."<br><br>";
                }
            }   
            $name = preg_replace('/Topic:/', '', $name);
            $name = preg_replace('/(Read [0-9]+ times)/', '', $name);
                $container[$ind]['name'] = $name;
                $container[$ind]['dob']  = $text;
                $container[$ind]['link'] = $link;
        }
        
    return $container;
    }
 

function findThread($context, $container, $html) 
    {
    foreach($html->find($context) as $line) {
        // print $line."<br>";
        $container[count($container)] = $line->href;
    }
    return $container;
    }


// print_r($links);
// print_r($storedDates);
