

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    
<style>
form {
  margin: 0 auto;
  width: 400px;
  padding: 1em;
  border: 1px solid #CCC;
  border-radius: 1em;
}

form div + div {
  margin-top: 1em;
}

label {
  display: inline-block;
  width: 90px;
  text-align: right;
}

input, textarea {
  font: 1em sans-serif;
  max-width: 300px;
  box-sizing: border-box;
  border: 1px solid #999;
}

input:focus, textarea:focus {
  border-color: #000;
}

textarea {
  vertical-align: top;
  height: 5em;
}

.button {
  padding-left: 90px; /* same size as the label elements */
}

button {
  margin-left: .5em;
}
</style>

</head>
<body>
<?php

$db = new mysqli('localhost', 'service', 'uAzSqu301Cke73wd', 'service');
if ($db->connect_errno) {
    echo 'Error connect to MySQL: (' . $db->connect_errno . ') ' . $db->connect_error;
}
$db->set_charset("utf8");
$query = $db->query("SELECT * FROM `news` ORDER BY `id` DESC");
?>
<?php session_start();;?>
<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'adm'): ?>
<form action="#" method="post">
<div>
        <label for="title">title:</label>
        <input type="text" id="title" name="title">
    </div>
    <div>
        <label for="short">Add a file?</label>
        <input type="radio" id="short" name="short" value='1'>No
         <input type="radio" id="short" name="short" value='0'>Yes
    </div>
    <div>
        <label for="text">text:</label>
        <textarea id="msg" name="text"></textarea>
    </div>
    <div>
     <input type="submit" name='submit' value='send'></input>     </div>
</form>
<?php endif;?> 

 <?php while ($row = $query->fetch_assoc()): ?>
 <hr>
 <ul>
 <li> <?=$row['title'];?> </li>
 <li> <a href="http://hubcoin.io/releases/<?= $row['id'];?>.php">Click to read</a> </li>
 </ul> 
 <hr>
 <?php endwhile;?>


