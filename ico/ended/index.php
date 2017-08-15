<?php

require_once "../add/database.php";
// include_once "trackers/parser.php";

$db = new Database();
$i = 0;
$finished = [];

$finished = $db->dumpOld();


include_once 'view.php';