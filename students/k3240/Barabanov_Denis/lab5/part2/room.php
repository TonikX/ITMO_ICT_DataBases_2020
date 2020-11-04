<?php

$dbuser = 'postgres';
$dbpass = '0308';
$host = 'localhost';
$dbname='postgres';
$pdo = new PDO("pgsql:host=$host; dbname=$dbname", $dbuser, $dbpass);
$result = $pdo->query('SELECT * FROM public.room
                       ORDER BY room');
$table = "public.room";
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
            	   			<form action="roomtype.php">
            	   				<button class="btn btn-light">roomtype</button>
							</form></br>
            			</div>
				<div class="col mt-1">
					<h2>room</h2>
					<p></p>
					<form class="form-row" method="post" action="room.php">
						 <div class="form-group"><input type="text" class="form-control" name="room" placeholder="Введите room"></div>
						 <div class="form-group"><input type="submit" name="del_btn" class="btn btn-outline-secondary" value="Удалить"/></div>
					</form>
					<hr>
					<form method="post">
						<div class="form-group"><input type="text" class="form-control" name="room" placeholder="room "></div>
						<div class="form-group"><input type="text" class="form-control" name="phone" placeholder="phone "></div>
						<div class="form-group"><input type="text" class="form-control" name="floor" placeholder="floor "></div>
						<div class="form-group"><input type="text" class="form-control" name="roomtype" placeholder="roomtype "></div>
						<input type="submit" name="add_btn"
				           class="btn btn-outline-secondary" value="Добавить"/>
					</form>
				</div>
			</div><p></p>

   			<table class="table">
				<thead class="thead-lightlight">
					<tr>
						<th>room</th>
						<th>телефон</th>
						<th>этаж</th>
						<th>тип</th>
					</tr>
					<?php foreach ($result as $value) { ?>
					<tr>
						<td><?=$value['room'] ?></td>
						<td><?=$value['phone'] ?></td>
						<td><?=$value['floor'] ?></td>
						<td><?=$value['roomtype'] ?></td>
					</tr> <?php } ?>
				</thead>
			</table>
		</div>
	</body>
</html>

<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["del_btn"])) {
             $result = $pdo->query("DELETE from $table where room='$_POST[room]'");
         }

         if (isset($_POST["add_btn"])) {
             $result = $pdo->query("INSERT INTO  $table (room, phone, floor, roomtype) values (
            '$_POST[room]',
			'$_POST[phone]',
			'$_POST[floor]',
			'$_POST[roomtype]')");
         }

         echo "<meta http-equiv='refresh' content='0'>";
     }


?>