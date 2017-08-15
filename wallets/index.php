<?php


$dir = './';
$i = 0;

$keys = scandir($dir);

foreach($keys as $key){
    if(preg_match('/UTC/', $key)) {
        $parts = explode('--', $key);
        $addr[$i] = '0x'.$parts['2'];
        $i++;
    }
}

// print '<pre>'; print_r($addr); print '</pre>';


$i=0;
$db = new mysqli('localhost', 'service', 'uAzSqu301Cke73wd', 'service');
if ($db->connect_errno) {
    echo 'Error connect to MySQL: (' . $db->connect_errno . ') ' . $db->connect_error;
}
$db->set_charset("utf8");
$query = $db->query("SELECT * FROM `ico`");

while ($row = $query->fetch_assoc()){
    $ico[$i] = $row;
    $i++;
}

$y = 0;
foreach($ico as $line){
    $db = new mysqli('localhost', 'service', 'uAzSqu301Cke73wd', 'service');
    if ($db->connect_errno) {
        echo 'Error connect to MySQL: (' . $db->connect_errno . ') ' . $db->connect_error;
    }
    $db->set_charset("utf8");
    $name = $line['name'];
    $addres = $addr[$y];
    if($line['wallet'] == 'none' || $line['wallet'] == '' || !isset($line['wallet'])) {
        print $name.'  @ '.$addres;
    $query = $db->query("UPDATE ico SET wallet = '$addres' WHERE name = '$name'");
    $db->close();
    }
    // $db->execute();
    $y++;
}