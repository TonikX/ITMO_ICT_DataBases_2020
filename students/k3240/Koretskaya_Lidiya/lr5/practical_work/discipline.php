<?php

$dbuser = 'postgres';
$dbpass = 'admin';
$pdo = new PDO("pgsql:host='localhost';dbname='college'", $dbuser, $dbpass);
$result = $pdo->query("SELECT * FROM discipline ORDER BY id_discipline");
$table = "public.discipline";
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
					<h2>Discipline</h2>
					<p></p>
					<form class="form-row" method="post" action="discipline.php">
						 <div class="form-group"><input type="text" class="form-control" name="id" placeholder="Введите id"></div>
						 <div class="form-group"><input type="submit" name="del_btn" class="btn btn-outline-danger" value="Удалить"/></div>
					</form>	
					<hr>				
					<form method="post">
						<div class="form-group"><input type="text" class="form-control" name="id_discipline" placeholder="id_discipline (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="title" placeholder="title (text)"></div>
						<div class="form-group"><input type="text" class="form-control" name="credit_units" placeholder="credit_units (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="academic_plan" placeholder="academic_plan (like 09.03.60)"></div>
						<input type="submit" name="add_btn"
				           class="btn btn-outline-success" value="Добавить"/>
				         <input type="submit" name="edit_btn"
				           class="btn btn-outline-info" value="Редактировать"/>
					</form>
				</div>
				<form action="main.php">
   					<button class="btn btn-outline-secondary">Назад</button>
	   			</form>
			</div><p></p>

   			<table class="table">
				<thead class="thead-lightlight">
					<tr>
						<th>id</th>
						<th>Фамилия</th>
						<th>Академ часы</th>
						<th>Учебный план</th>
					</tr>
					<?php foreach ($result as $value) { ?>
					<tr>
						<td><?=$value['id_discipline'] ?></td>
						<td><?=$value['title'] ?></td>
						<td><?=$value['credit_units'] ?></td>
						<td><?=$value['academic_plan'] ?></td>
					</tr> <?php } ?>
				</thead>
			</table>
		</div>
	</body>
</html>

<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["del_btn"])) {
             $result = $pdo->query("DELETE from $table where id_discipline='$_POST[id]'");
         }

         if (isset($_POST["add_btn"])) {
             $result = $pdo->query("INSERT into $table (id_discipline, title, credit_units, academic_plan) values (
            '$_POST[id_discipline]',
            '$_POST[title]',
            '$_POST[credit_units]', 
            '$_POST[academic_plan]')");
         }

         if (isset($_POST["edit_btn"])) {
             $result = $pdo->query("UPDATE $table set title='$_POST[title]',
              credit_units='$_POST[credit_units]',
              academic_plan='$_POST[academic_plan]' where id_discipline='$_POST[id_discipline]'");
         }

         echo "<meta http-equiv='refresh' content='0'>";
     }


?>