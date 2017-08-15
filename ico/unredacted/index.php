<?php


require_once "../add/database.php";

$db = new mysqli('localhost', 'service', 'uAzSqu301Cke73wd', 'service');
if ($db->connect_errno) {
    echo 'Error connect to MySQL: (' . $db->connect_errno . ') ' . $db->connect_error;
}
$db->set_charset("utf8");
$query = $db->query("SELECT * FROM `coinslist` WHERE name like '%ICO%' and readed = 1 ORDER BY `UNIXTIME` DESC");



// $db = new Database();
// $result = $db->showUnredacted();

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
  
    require_once "../add/database.php";
    $database    = new Database();
    $database->update($name, $description, $start, $end, $whitepaper, $source, $icopage, $forum, $git, $media);
    header("Location: http://hubcoin.io/ico");
}



include_once "view.php";