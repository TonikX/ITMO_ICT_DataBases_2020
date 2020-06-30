<?php

$dbuser = 'postgres';
$dbpass = 'admin';
$pdo = new PDO("pgsql:host='localhost';dbname='college'", $dbuser, $dbpass);
$result = $pdo->query("SELECT * FROM teaching ORDER BY id_teacher");
$table = "public.teaching";
?>

<!DOCTYPE html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container"><p></p>
			<div class="row">
				<div class="col mt-1">
					<h2>Teaching</h2>
					<p></p>
				</div>
				<form action="main.php">
   					<button class="btn btn-outline-secondary">Назад</button>
	   			</form>
			</div><p></p>

   			<table class="table">
				<thead class="thead-lightlight">
					<tr>
						<th>id преподавателя</th>
						<th>id предмета</th>
					</tr>
					<?php foreach ($result as $value) { ?>
					<tr>
						<td><?=$value['id_teacher'] ?></td>
						<td><?=$value['id_discipline'] ?></td>
					</tr> <?php } ?>
				</thead>
			</table>
		</div>
	</body>
</html>
