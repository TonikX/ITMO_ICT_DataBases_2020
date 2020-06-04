<?php
	header("Content-Type: text/plain; charset=utf-8");

	$dbuser = 'postgres';
	$dbpass = '89214483826';
	$host = 'localhost';
	$dbname= 'Dog_show';

	$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
	$query = "select 'Hi ' as field_1, '123' as field_2";
	$result = pg_query($db, $query);
	$result = pg_fetch_assoc($result);
	echo $result['field_1'];
	pg_close($db);

	
?>

