<?php

$db = new mysqli('localhost', 'service', 'uAzSqu301Cke73wd', 'service');
if ($db->connect_errno) {
    echo 'Error connect to MySQL: (' . $db->connect_errno . ') ' . $db->connect_error;
}
$db->set_charset("utf8");
$query = $db->query("SELECT * FROM `coins` ORDER BY `date_launched` DESC");
?>

<?php

require_once "..//parsers/modules/database/database.php";

$db = new Database();

$result = $db->dumpCoins();
$x = 0;
foreach($result as $line){
    $x +=1;
}

include_once 'view.php';