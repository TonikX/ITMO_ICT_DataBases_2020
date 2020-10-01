<?php
	$dbuser = 'postgres';
    $dbpassword = '741419Snega';
    $host = 'localhost';
    $dbname = 'test';
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser , $dbpassword );
?>