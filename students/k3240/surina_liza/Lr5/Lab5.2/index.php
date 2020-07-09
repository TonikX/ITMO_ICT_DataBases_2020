<?php

$dbuser = 'postgres';
$dbpass = '123';
$host = 'localhost';
$dbname='postgres';
$pdo = new PDO("pgsql:host=$host; dbname=$dbname", $dbuser, $dbpass);

$a1 = "01. запрос выводит ID служащих, которые работают на 12 этаже, но при этом не работают в воскресенье:";
$q1= "SELECT timetable.id_service
      FROM hotel.timetable, hotel.number
      WHERE number.floor = 12
      AND timetable.number_code = number.number_code
      AND NOT EXISTS (
      SELECT timetable.id_service
      FROM hotel.timetable, hotel.number
      WHERE weekday='sunday')";

$a2 = "02. запрос выводит код и цену номера, стоимость которых превышает 20000р. и отсортированных по цене:";
$q2 = 'SELECT DISTINCT number.number_code, type.price
       FROM hotel.number, hotel.type
       WHERE type.price > 20000 AND number.type_number = type.type_number ORDER BY price';

$a3 = "03. показывает ФИО и номер в отеле:";
$q3 = 'SELECT client.full_name, reserv.number_code
              FROM hotel.reserv INNER JOIN hotel.client
              ON client.id_client = reserv.id_client';

$a4 = "04. выводит цену и номер, у которых общая цена больше цены всех номеров и отсортированных по цене:";
$q4 = 'SELECT DISTINCT number_code, total
       FROM hotel.report, hotel.type
       WHERE total > ALL(
       SELECT price
       FROM hotel.type) ORDER BY total';

$a5 = "05. выводит ID регистрации, ФИО клиентов не из Москвы, их паспортные данные:";
$q5 = "SELECT code_reservation, full_name AS name, passport_number AS passport
       FROM hotel.client INNER JOIN hotel.reserv
       ON client.id_client = reserv.id_client
       WHERE city != 'Moscow' ORDER BY name";

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
				<form action="admin.php">
	   				<button class="btn btn-light">ADMIN</button>
	   			</form></br>
	   			<form action="client.php">
	   				<button class="btn btn-light">CLIENT</button>
	   			</form></br>
	   			<form action="number.php">
	   				<button class="btn btn-light">NUMBER</button>
	   			</form></br>
	   			<form action="report.php">
	   				<button class="btn btn-light">REPORT</button>
	   			</form></br>
	   			<form action="reserv.php">
	   				<button class="btn btn-light">RESERV</button>
	   			</form></br>
	   			<form action="service.php">
	   				<button class="btn btn-light">SERVICE</button>
	   			</form></br>
	   			<form action="timetable.php">
	   				<button class="btn btn-light">TIMETABLE</button>
	   			</form></br>
	   			<form action="type.php">
	   				<button class="btn btn-light">TYPE</button>
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
