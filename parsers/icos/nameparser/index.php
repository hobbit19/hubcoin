<?php


/* 
      парсит упоминания о каждой монете на всех введенных трекерах ИКО
*/



include_once "parser.php";
require_once "../../modules/database/database.php";


$db = new Database();
$result = $db->showAll();


$tokens = ICOparser::parse($result);


if($tokens) {
      $file = file_get_contents('log.txt');

      require_once "../../modules/database/database.php";


      $db = new Database();
      $result = $db->showAll();
      $i = 0;
      $myfile = fopen("num.txt", "w");
      foreach($result as $name){
            if($name['name'] != '' && $name['name'] !='DELETE') $number = substr_count($file, $name['name']);
            if($number > 0)  {
                  $i +=1;
                  print $name['name'].' '.$number.' \n ';
                  $txt = $name['name'].' '.$number.' \n ';
                  fwrite($myfile, $txt);
                  $db->enlistme($name['name'], $number);
            }
      }
      print $i;
      fclose($myfile);
}