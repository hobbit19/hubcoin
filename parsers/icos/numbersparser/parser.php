<?php


require_once "../../../parser/modules/simplehtmldom/simple_html_dom.php";

class ICOparser
{

      public static function parse()
      {
            $opts = array(
                  'http'=>array('method'=>"GET",'header'=>"Accept-language: en\r\n" ."User-Agent: not for you\r\n"), 
                  "ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false)
                  );
            $context = stream_context_create($opts);
            $html = new simple_html_dom();

            $icos = [array('site'=> 'https://icotracker.net/',
                           'tag'=>' div div[class=container-wrp] div[class=row] div[class=col-12] div[class=card-project] div[class=card-block]'), 
                     array('site'=> 'http://www.icocountdown.com/',
                           'tag'=> '*[class=project-overlay]'), 
                     array('site'=> 'https://ico-list.com/',
                           'tag'=> '*[class=coinRow pointer]',
                           'active' => '*[id=coinlist] *[class=coinRow pointer]'), 
                     array('site'=> 'https://icobazaar.com/list/',
                           'tag'=> '*[class=ng-scope]'), 
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
                     array('site'=> 'https://www.ico365.com/calendar', 
                           'tag' => ''),  
                     array('site'=> 'https://www.icoage.com/',  
                           'tag' => ''),
                     array('site'=> 'https://www.smithandcrown.com/icos/',  
                           'tag' => ''),
                     array('site'=> 'https://www.coingecko.com/ico?locale=en',  
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
                  $y = 3;
                  for($y = 17; $y <= 17; $y ++){
                        $html = file_get_html($icos[$y]['site'], false, $context);
                        $i = 0;
                        $a = 0;
                        if($html and $html->plaintext!='' and count($html->find('div'))) {
                              foreach ($html->find($icos[$y]['tag']) as $ico) {
                                    $i += 1;
                              }
                              if(isset($icos[$y]['active'])) {
                                    foreach ($html->find($icos[$y]['active']) as $active) {
                                          $a += 1;
                                    }
                              }
                        if ($a < 1 && $i >0) print $icos[$y]['site']." ICOs listed: ".$i."<br>";
                        elseif ($a >1 && $i > 0) print $icos[$y]['site']." ICOs listed: ".$i." where active ICOs are ".$a."<br>";
                        else print "unable to find ".$icos[$y]['tag']." in ".$icos[$y]['site'];
                        }
                  }
      }
}