<?php


$ua=$_SERVER['HTTP_USER_AGENT'];

file_put_contents('ua.txt', $ua);