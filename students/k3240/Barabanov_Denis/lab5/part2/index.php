<?php

$dbuser = 'postgres';
$dbpass = '0308';
$host = 'localhost';
$dbname='postgres';
$pdo = new PDO("pgsql:host=$host; dbname=$dbname", $dbuser, $dbpass);

$a1 = "01.запрос выводит имена служащих, которые работают на 1 этаже, но при этом не работают в понедельник:";
$q1= "SELECT workers.surname
	FROM timetable, workers
	WHERE timetable.floor=1 and workers.id = timetable.worker
	EXCEPT  ( 
	SELECT workers.surname
	FROM timetable, workers
	WHERE day='понедельник' and workers.id = timetable.worker)";

$a2 = "02. выводит кол-во людей выселившихся в ноябре 2020 года:";
$q2 = "SELECT COUNT(DISTINCT(name))
		from customer
		where
		EXTRACT(month FROM upper(customer.arrival)::date) = 11 and
		EXTRACT(year FROM upper(customer.arrival)::date) = 2020";

$a3 = "03. считает сумму полученную с номеров людей зи СПб:";
$q3 = "SELECT
		UPPER(daterange(customer.arrival)) -
			LOWER(daterange(customer.arrival)) AS days,
		customer.name,
		roomtype.copacity,
		roomtype.price*(UPPER(daterange(customer.arrival)) -
			LOWER(daterange(customer.arrival))) as totalsum
		from customer, room, roomtype, contract
		where customer.city = 'Spb' and 
		customer.passport = contract.passport and
		contract.room = room.room and
		room.roomtype = roomtype.id";

$a4 = "04. показывает ФИО и номер в отеле:";
$q4 = 'SELECT customer.surname, contract.room
		FROM contract INNER JOIN customer
		ON customer.passport = contract.passport';

$a5 = "05. запрос показывает кол-во клиентов из Москвы живших на 2 этаже";
$q5 = "SELECT COUNT(DISTINCT(customer.name))
		FROM customer, room, contract
		WHERE customer.city = 'Moscow' AND 
		contract.passport = customer.passport and 
		contract.room = room.room and 
		room.floor = 2";

$q = array($q1, $q2, $q3, $q4, $q5);
$a = array($a1, $a2, $a3, $a4, $a5);
?>

<!DOCTYPE html>
	<head>
		<meta charset="UTF-8">
		 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>

		<div class="container">
			<div class="row">
			    <form action="index.php">
                    <button class="btn btn-light">QUERY</button>
                </form></br>
				<form action="administrator.php">
	   				<button class="btn btn-light">administrator</button>
	   			</form></br>
	   			<form action="customer.php">
	   				<button class="btn btn-light">customer</button>
	   			</form></br>
	   			<form action="room.php">
	   				<button class="btn btn-light">room</button>
	   			</form></br>
	   			<form action="contract.php">
	   				<button class="btn btn-light">contract</button>
	   			</form></br>
	   			<form action="workers.php">
	   				<button class="btn btn-light">workers</button>
	   			</form></br>
	   			<form action="timetable.php">
	   				<button class="btn btn-light">timetable</button>
	   			</form></br>
	   			<<form action="roomtype.php">
            	   	<button class="btn btn-light">roomtype</button>
				</form></br>
			</div>
			<br>
			<h2>запросы к таблицам</h2>

			<?php
			for ($i=0; $i < 5; $i++) {
				echo "<p>".$a[$i]."<p>";
				$result = $pdo->query($q[$i]);
				foreach ($result as $data) {
						$p = 0;
						while ($p != $result->columnCount()) {
						print_r($data[$p]." ");
						$p+=1;

					}

					echo "</br>";}
			}

			?>
			</p>

		</div>
	</body>
</html>
