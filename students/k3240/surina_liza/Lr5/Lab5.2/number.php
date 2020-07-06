<?php

$dbuser = 'postgres';
$dbpass = '123';
$host = 'localhost';
$dbname='postgres';
$pdo = new PDO("pgsql:host=$host; dbname=$dbname", $dbuser, $dbpass);
$result = $pdo->query('SELECT * FROM hotel.number
                       ORDER BY number_code');
$table = "hotel.number";
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
					<h2>Number</h2>
					<p></p>
					<form class="form-row" method="post" action="client.php">
						 <div class="form-group"><input type="text" class="form-control" name="id" placeholder="Введите id"></div>
						 <div class="form-group"><input type="submit" name="del_btn" class="btn btn-outline-secondary" value="Удалить"/></div>
					</form>
					<hr>
					<form method="post">
						<div class="form-group"><input type="text" class="form-control" name="number_code" placeholder="number_code "></div>
						<div class="form-group"><input type="text" class="form-control" name="type_number" placeholder="type_number "></div>
						<div class="form-group"><input type="text" class="form-control" name="telephone" placeholder="telephone"></div>
						<div class="form-group"><input type="text" class="form-control" name="floor" placeholder="floor "></div>
						<input type="submit" name="add_btn"
				           class="btn btn-outline-secondary" value="Добавить"/>
					</form>
				</div>
			</div><p></p>

   			<table class="table">
				<thead class="thead-lightlight">
					<tr>
						<th>код номера</th>
						<th>тип номера</th>
						<th>телефон</th>
						<th>этаж</th>
					</tr>
					<?php foreach ($result as $value) { ?>
					<tr>
						<td><?=$value['number_code'] ?></td>
						<td><?=$value['type_number'] ?></td>
						<td><?=$value['telephone'] ?></td>
						<td><?=$value['floor'] ?></td>
					</tr> <?php } ?>
				</thead>
			</table>
		</div>
	</body>
</html>

<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["del_btn"])) {
             $result = $pdo->query("DELETE from $table where number_code='$_POST[id]'");
         }

         if (isset($_POST["add_btn"])) {
             $result = $pdo->query("INSERT INTO  $table (number_code, type_number, telephone, floor) values (
            '$_POST[number_code]',
            '$_POST[type_number]',
            '$_POST[telephone]',
            '$_POST[floor]')");
         }

         echo "<meta http-equiv='refresh' content='0'>";
     }


?>