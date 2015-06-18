<?php

/*

*/



$mySQLserver = "localhost";
$mySQLuser = "root";
$mySQLpassword = "";
$mySQLdefaultdb = "kronologger2015";
$host = "localhost/kronologger2015";

$dsn = 'mysql:host=localhost;dbname=kronologger2015';
$username = 'root';
$password = '';

$options = array(
PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
$link = new PDO($dsn, $username, $password, $options);
$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$link->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


?>
