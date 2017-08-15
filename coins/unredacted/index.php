<?php

require_once('../../parsers/modules/database/database.php');
$db = new Database();

if (isset($_POST['submit']))
		{   
            
			$options['name'] = $_POST['name'];
            $options['description'] = $_POST['description'];
            $options['algo'] = $_POST['algo'];
            $options['forum'] = $_POST['forum'];
			$options['site'] = $_POST['site'];
            $options['datel'] = $_POST['datel'];
            $options['datel'] = date("Y-d-m", strtotime($options['datel']));
            // print_r($options);
            //die();
            $db->addNew($options);
            $db->enlist($_POST['forum']);
            header('Location: http://hubcoin.io/newcoins');
            
		}


require_once('view.php');