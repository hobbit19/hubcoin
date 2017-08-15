<?php

include_once("../parser/modules/database/db_conf.php");
include_once("../parser/modules/database/init.php");

$db = new Database();

function take($d){
    $d = Database::Connect();
    $outputs = [];    
    $sql = 'SELECT dob, name FROM coinslist';
    $d->query("SET NAMES 'UTF8'");
    $result = $d->prepare($sql);
    $result = $d->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);

    for($i=0; $row = $result->fetch(); $i++)
     {	
        $outputs[$i]['dob'] = $row['dob']; 
        $outputs[$i]['name'] = $row['name'];       
     }
    return $outputs;
        
}

function names() {
    $d = Database::Connect();
    $outputs = [];    
    $sql = 'SELECT name FROM coinslist';
    $d->query("SET NAMES 'UTF8'");
    $result = $d->prepare($sql);
    $result = $d->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);

    for($i=0; $row = $result->fetch(); $i++)
     {	
        $outputs[$i]['name'] = $row['name'];          
     }
    foreach($outputs as $line) {
        
    
    }
}

function put($line, $d){
    
        $d = Database::Connect();
        $sql = "UPDATE coinslist SET UNIXTIME = ".$line['tt']."  WHERE dob = '".$line['dob']."'";
        $d->query("SET NAMES 'UTF8'");
        $result = $d->prepare($sql);
       // print $sql . "<br/>"; 
        // die();
        return $result->execute();
}



$lines = take($db);
$newlines = [];
$i = 0;

date_default_timezone_set('UTC');

foreach($lines as $line){
    if (preg_match('/\(\)/', $line['name'])) {
            preg_replace('/\(\)/', '', $line['name']);
    }
    if (preg_match('/Today/', $line['dob'])) {
        // print date("m.d.y");
        $timenow = date("F j, Y");
        $line['tt'] = strtotime($timenow);
        // print $line['dob'];
        //die();
        
    }
    $line['tt'] = strtotime($line['dob']);
    $newlines[$i]['tt'] = $line['tt'];
    $newlines[$i]['dob'] = $line['dob'];
    $newlines[$i]['name'] = $line['name'];
    $i++;
}
 
 
// print_r($newlines);

foreach($newlines as $line){
    if($line['dob'] == "" || $line['dob'] == null || !isset($line['dob'])) {
        
        // print 'before'.$line['dob'];
        $line['dob'] = date("F j, Y");
        $line['tt'] = strtotime($line['dob']);
        // print '<br> AFTER -> '.$line['dob'].'<<<';
       
    } 
     if (preg_match('/Today/', $line['dob'])) {
        // print date("m.d.y");
        $timenow = date("F j, Y");
        $line['tt'] = strtotime($timenow);
        }
    // print $line['dob'].'<br>';
    put($line, $db);
}

// print "<pre>";
// print_r($lines);
// print "</pre>";