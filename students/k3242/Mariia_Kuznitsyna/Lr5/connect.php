<?php

include 'config.php';

$pdo_database = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
