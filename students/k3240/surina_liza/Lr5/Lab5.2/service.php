<?php

$dbuser = 'postgres';
$dbpass = '123';
$host = 'localhost';
$dbname='postgres';
$pdo = new PDO("pgsql:host=$host; dbname=$dbname", $dbuser, $dbpass);
$result = $pdo->query('SELECT * FROM hotel.service
                       ORDER BY id_service');
$table = "hotel.service";
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
					<h2>Service</h2>
					<p></p>
					<form class="form-row" method="post" action="service.php">
						 <div class="form-group"><input type="text" class="form-control" name="id" placeholder="Введите id"></div>
						 <div class="form-group"><input type="submit" name="del_btn" class="btn btn-outline-secondary" value="Удалить"/></div>
					</form>
					<hr>
					<form method="post">
						<div class="form-group"><input type="text" class="form-control" name="id_service" placeholder="id_service "></div>
						<div class="form-group"><input type="text" class="form-control" name="full_name" placeholder="full_name "></div>
						<input type="submit" name="add_btn"
				           class="btn btn-outline-secondary" value="Добавить"/>
					</form>
				</div>
			</div><p></p>

   			<table class="table">
				<thead class="thead-lightlight">
					<tr>
						<th>id служащего</th>
						<th>ФИО</th>
					</tr>
					<?php foreach ($result as $value) { ?>
					<tr>
						<td><?=$value['id_service'] ?></td>
						<td><?=$value['full_name'] ?></td>
					</tr> <?php } ?>
				</thead>
			</table>
		</div>
	</body>
</html>

<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["del_btn"])) {
             $result = $pdo->query("DELETE from $table where id_service='$_POST[id]'");
         }

         if (isset($_POST["add_btn"])) {
             $result = $pdo->query("INSERT INTO  $table (id_service, full_name) values (
            '$_POST[id_service]',
            '$_POST[full_name]')");
         }

         echo "<meta http-equiv='refresh' content='0'>";
     }


?>