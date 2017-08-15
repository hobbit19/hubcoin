<?php

require_once('database.php');
$db = new Database();

if (isset($_POST['submit']))
		{   if(strlen($options['description']) > 415) {
            echo "sorry, too big description";
        }   else {
            $options['datel'] = date("Y-d-m", strtotime($options['datel']));
			$options['name'] = $_POST['name'];
            $options['description'] = $_POST['description'];
            $options['algo'] = $_POST['algo'];
            $options['forum'] = $_POST['forum'];
            $options['stage'] = $_POST['stage'];
			$options['site'] = $_POST['site'];
            $options['datel'] = $_POST['datel'];
            // print_r($options);
            //die();
            $db->addNew($options);
            header('Location: http://hubcoin.io/newcoins');
            }
		}


require_once('view.php');