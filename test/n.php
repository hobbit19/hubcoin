<?php

function between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}


function between_multi($string, $start, $end){
    $split_string       = explode($end,$string);
    foreach($split_string as $data) {
         $str_pos       = strpos($data,$start);
         $last_pos      = strlen($data);
         $capture_len   = $last_pos - $str_pos;
         $result      = substr($data,$str_pos,$capture_len);
         if (strpos(" $result", "$start")){
             $return[]=substr($result, strlen($start));
         }else{
             //print "$result !!! $start \n\n";
         }
    }
    return $return;
}




for ($i=1; $i<2000; $i++){

    $data=file_get_contents("https://chainz.cryptoid.info/nro/block.dws?$i");

    $hash=between($data, '<code class="hash">', '</code>');


    //print $hash . "<br/>";

    $link="https://chainz.cryptoid.info/explorer/block.txs.dws?coin=nro&h=$hash&fmt.js";

    $info=file_get_contents($link);

    //print $info . "<br/>"; 


    $wallets=between_multi($info, '{"a":"', '}');
    //$wallets=between_multi($info, '"outputs":[{"a":"', '",');

    //print_r($wallets);
    
    foreach ($wallets as $k=>$v){
        $sum=between($v."finish", '"v":', 'finish');
        print "sum: $sum";
    }
    

    
    // (count($wallets) > 1){
    
    if (count($wallets) > 1){
        print_r($wallets);
    }
    
    
    print "<br/>=======================<br/>";
    
    continue;

    foreach ($wallets as $k=>$v){
        $all[$v]++;
    }
    
}

print_r($all);

foreach ($all as $k=>$v){
   print $k;
}


?>