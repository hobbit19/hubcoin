<?php

require_once "add/database.php";
// inc  lude_once "trackers/parser.php";


if(isset($_POST['submit'])){
    $name        = $_POST['name'];
    $description = $_POST['description'];
    $start       = $_POST['start'];
    $end         = $_POST['finish'];
    $whitepaper  = $_POST['whpaper'];
    $source      = $_POST['source'];
    $icopage     = $_POST['site'];
    $forum       = $_POST['forum'];
    $git         = $_POST['code'];
    $media       = $_POST['media'];
    $indexation  = $_POST['indexation'];
    $wallet      = 'none yet';
    $database    = new Database();
    $database->update($name, $description, $start, $end, $whitepaper, $source, $icopage, $forum, $git, $media, $wallet);
    date_default_timezone_set('Etc/GMT+3');
    $date = date('m/d/Y h:i:s a', time());
    $ip = $_SERVER['REMOTE_ADDR'];
    $log = $ip.' \n '.$date.' \n '.$name.' \n '.$description.' \n '.$start.' \n '.$end.' \n '.$whitepaper.' \n '.$source.' \n '.$icopage.' \n '.$forum.' \n '.$git.' \n '.$media.' \n '.$indexation.' \n\n\n';
    file_put_contents('addlog.txt', $log, FILE_APPEND);
}

$db = new Database();
$result = $db->showAll();

$unrdctd = $db->coinslist();


include_once 'view.php';