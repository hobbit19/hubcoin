<?php

include_once "parser.php";
require_once "../../add/database.php";


$db = new Database();
$result = $db->showAll();


    $tokens = ICOparser::parse($result);