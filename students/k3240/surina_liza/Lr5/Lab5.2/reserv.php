<?php

$dbuser = 'postgres';
$dbpass = '123';
$host = 'localhost';
$dbname='postgres';
$pdo = new PDO("pgsql:host=$host; dbname=$dbname", $dbuser, $dbpass);
$result = $pdo->query('SELECT * FROM hotel.reserv
                       ORDER BY code_reservation');
$table = "hotel.reserv";
?>

<!DOCTYPE html>
	<head>
		<meta charset="UTF-8">
		 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>
		<div class="container"><p></p>
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
				<div class="col mt-1">
					<h2>Reserv</h2>
					<p></p>
					<form class="form-row" method="post" action="reserv.php">
						 <div class="form-group"><input type="text" class="form-control" name="id" placeholder="Введите id"></div>
						 <div class="form-group"><input type="submit" name="del_btn" class="btn btn-outline-secondary" value="Удалить"/></div>
					</form>
					<hr>
					<form method="post">
						<div class="form-group"><input type="text" class="form-control" name="code_reservation" placeholder="code_reservation "></div>
						<div class="form-group"><input type="text" class="form-control" name="id_client" placeholder="id_client "></div>
						<div class="form-group"><input type="text" class="form-control" name="input" placeholder="input "></div>
						<div class="form-group"><input type="text" class="form-control" name="output" placeholder="output "></div>
						<div class="form-group"><input type="text" class="form-control" name="number_code" placeholder="number_code "></div>

						<input type="submit" name="add_btn"
				           class="btn btn-outline-secondary" value="Добавить"/>
					</form>
				</div>
			</div><p></p>

   			<table class="table">
				<thead class="thead-lightlight">
					<tr>
						<th>код резервирования</th>
						<th>id клиента</th>
						<th>дата заселения</th>
						<th>дата выселения</th>
						<th>код номера </th>
					</tr>
					<?php foreach ($result as $value) { ?>
					<tr>
						<td><?=$value['code_reservation'] ?></td>
						<td><?=$value['id_client'] ?></td>
						<td><?=$value['input'] ?></td>
						<td><?=$value['output'] ?></td>
						<td><?=$value['number_code'] ?></td>

					</tr> <?php } ?>
				</thead>
			</table>
		</div>
	</body>
</html>

<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["del_btn"])) {
             $result = $pdo->query("DELETE from $table where code_reservation='$_POST[id]'");
         }

         if (isset($_POST["add_btn"])) {
             $result = $pdo->query("INSERT INTO  $table (code_reservation, id_client, input, output, number_code) values (
            '$_POST[code_reservation]',
            '$_POST[id_client]',
            '$_POST[input]',
            '$_POST[output]',
            '$_POST[number_code]')");
         }

         echo "<meta http-equiv='refresh' content='0'>";
     }


?>