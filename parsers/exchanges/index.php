<?php

$db = new mysqli('localhost', 'service', 'uAzSqu301Cke73wd', 'service');
if ($db->connect_errno) {
    echo 'Error connect to MySQL: (' . $db->connect_errno . ') ' . $db->connect_error;
}
$db->set_charset("utf8");
$query = $db->query("SELECT * FROM `markHist`");

while ($row = $query->fetch_assoc()){
    print '<pre>'; print_r($row); print '</pre>';
}