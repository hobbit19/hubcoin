<?php

/* 
      парсит упоминания о каждой монете на всех введенных трекерах ИКО
*/
ini_set('max_execution_time', 900);

require_once "../../modules/simplehtmldom/simple_html_dom.php";




class ICOparser
{

      public static function parse($names)
      {
            $opts = array(
                  'http'=>array('method'=>"GET",'header'=>"Accept-language: en\r\n" ."User-Agent: not for you\r\n"), 
                  "ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false)
                  );
            $context = stream_context_create($opts);
            $html = new simple_html_dom();

            $icos = [array('site'=> 'https://icotracker.net/',
                           'div'=> 'div[class=sticky-container] div[class=sticky-content] div',
                           'tag'=>' div div[class=container-wrp] div[class=row] div[class=col-12] div[class=card-project] div[class=card-block]'), 
                     array('site'=> 'http://www.icocountdown.com/',
                           'tag'=> ''), 
                     array('site'=> 'https://ico-list.com/',
                           'tag'=> ''), 
                     array('site'=> 'https://icobazaar.com/list/',
                           'tag'=> ''), 
                     array('site'=> 'https://www.icoalert.com/',
                           'tag'=> ''),
                     array('site'=> 'https://www.coinschedule.com/',
                           'tag' => ''),
                     array('site'=> 'https://icostats.com/',
                           'tag' => ''),
                     array('site'=> 'https://cyber.fund/radar',
                           'tag' => ''),
                     array('site'=> 'http://icorating.com/', 
                           'tag' => ''),
                     array('site'=> 'http://cryptocurrency.tech/ico/', 
                           'tag' => ''),
                     array('site'=> 'https://www.ico365.com/', 
                           'tag' => ''), 
                     array('site'=> 'http://www.icocountdown.com/', 
                           'tag' => ''), 
                     array('site'=> 'https://www.icoage.com/',  
                           'tag' => ''),
                     array('site'=> 'https://tokenhub.com/', 
                           'tag' => ''), 
                     array('site'=> 'https://btc9.com/',  
                           'tag' => ''),
                     array('site'=> 'https://www.smithandcrown.com/icos/',  
                           'tag' => ''),
                     array('site'=> 'https://www.coingecko.com/en',  
                           'tag' => ''),
                     array('site'=> 'https://cointelegraph.com/ico-calendar',  
                           'tag' => ''),
                     array('site'=> 'http://www.the-blockchain.com/ico-list-com/',  
                           'tag' => ''),
                     array('site'=> 'http://www.52ico.com/',  
                           'tag' => ''),
                     array('site'=> 'https://tokenmarket.net/ico-calendar', 
                           'tag' => 'table[class=table] tbody tr td[class=col-asset-name] a')];
            // print "<pre>";
            // print_r($icos);
            // print "</pre>";
            // print $icos[0]['tag'];
            $namesarray = [];
            $myfile = fopen("log.txt", "w");
            $db = new Database(); 
            for($y=0;$y<21;$y++){
               $html = file_get_html($icos[$y]['site'], false, $context);
                  foreach($names as $name){
                        $string = str_replace(' ', '', $name['name']);
                        $string = preg_replace('/\s+/', '', $string);
                        $pregname = "/".$string."/i";
                        $i = 0;
                        if($html and $html->plaintext!='' and count($html->find('div'))) {
                              foreach($html->find('body') as $block){
                                    if (preg_match($pregname, $block))  $i +=1;
                              }
                        }
                        if ($i>0) $txt = $icos[$y]['site']." @ ".$string.":".$i."\n ";
                        else $txt = " ";
                        print $txt;
                        
                        fwrite($myfile, $txt);
                       
                  }
                  // $html->clear(); 
			// unset($html);
            }
            fclose($myfile);
            return $namesarray;
      }
}