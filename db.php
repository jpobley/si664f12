<?php
$db = mysql_connect("localhost","root", "root");
if ( $db === FALSE ) die('Could not connect to database');
if ( mysql_select_db("sicourserate") === FALSE ) die("Could not connect to database");
?>