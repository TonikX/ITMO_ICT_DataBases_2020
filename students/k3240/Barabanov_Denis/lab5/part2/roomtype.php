<?php

$dbuser = 'postgres';
$dbpass = '0308';
$host = 'localhost';
$dbname='postgres';
$pdo = new PDO("pgsql:host=$host; dbname=$dbname", $dbuser, $dbpass);
$result = $pdo->query('SELECT * FROM public.roomtype
                       ORDER BY id');
$table = "public.roomtype";
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
					<h2>roomtype</h2>
					<p></p>
					<form class="form-row" method="post" action="roomtype.php">
						 <div class="form-group"><input type="text" class="form-control" name="id" placeholder="Введите id"></div>
						 <div class="form-group"><input type="submit" name="del_btn" class="btn btn-outline-secondary" value="Удалить"/></div>
					</form>
					<hr>
					<form method="post">
						<div class="form-group"><input type="text" class="form-control" name="id" placeholder="id "></div>
						<div class="form-group"><input type="text" class="form-control" name="price" placeholder="price "></div>
						<div class="form-group"><input type="text" class="form-control" name="copacity" placeholder="copacity "></div>
						<input type="submit" name="add_btn"
				           class="btn btn-outline-secondary" value="Добавить"/>
					</form>
				</div>
			</div><p></p>

   			<table class="table">
				<thead class="thead-lightlight">
					<tr>
						<th>id</th>
						<th>цена</th>
						<th>вместимость</th>
					</tr>
					<?php foreach ($result as $value) { ?>
					<tr>
						<td><?=$value['id'] ?></td>
						<td><?=$value['price'] ?></td>
						<td><?=$value['copacity'] ?></td>
					</tr> <?php } ?>
				</thead>
			</table>
		</div>
	</body>
</html>

<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["del_btn"])) {
             $result = $pdo->query("DELETE from $table where id='$_POST[id]'");
         }

         if (isset($_POST["add_btn"])) {
             $result = $pdo->query("INSERT INTO  $table (id, price, copacity) values (
            '$_POST[id]',
			'$_POST[price]',
            '$_POST[copacity]')");
         }

         echo "<meta http-equiv='refresh' content='0'>";
     }


?>