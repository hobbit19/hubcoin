<?php

require_once '../parsers/modules/database/database.php';

if(isset($_POST['submit'])){
    $opt['title'] = $_POST['title'];
    $opt['add_file'] = $_POST['short'];
    $opt['text'] = $_POST['text'];
    $db = new Database();
    $id = $db->article($opt);
    $text = "<h1>".$opt['title']."</h1><br><br><p>".$opt['text']."</p>";
    $fi = $id.".php";
    $fp = fopen($fi, "w");
    fwrite($fp, $text);
    fclose($fp);
    header("Location /releases/");
}
require_once('view.php');