<?php/*
*/$mySQLserver = "localhost";
$mySQLuser = "root";
$mySQLpassword = "";
$mySQLdefaultdb = "kronologger2015";
$host = "localhost/kronologger2015";
$link = mysql_connect($mySQLserver, $mySQLuser, $mySQLpassword) or die ("Could not connect to MySQL");mysql_select_db ($mySQLdefaultdb) or die ("Could not select database");
?>