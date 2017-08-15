<?php

$dir = '';
$i = 0;

$keys = scandir($dir);

foreach($keys as $key){
    $parths = explode('--', $key);
    $addr[$i] = '0x'.$parts['2'];
    $i++;
}