<?php

$dbuser = 'postgres';
$dbpass = 'admin';
$pdo = new PDO("pgsql:host='localhost';dbname='college'", $dbuser, $dbpass);
$result = $pdo->query("SELECT * FROM timetable ORDER BY class_data");
$table = "public.timetable";
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
					<h2>Timetable</h2>
					<p></p>
					<form class="form-row" method="post" action="timetable.php">
						 <div class="form-group"><input type="text" class="form-control" name="id" placeholder="Введите id"></div>
						 <div class="form-group"><input type="submit" name="del_btn" class="btn btn-outline-danger" value="Удалить"/></div>
					</form>	
					<hr>				
					<form method="post">
						<div class="form-group"><input type="text" class="form-control" name="class_data" placeholder="class_data (like 2000-01-30)"></div>
						<div class="form-group"><input type="text" class="form-control" name="number_of_discipline" placeholder="number_of_discipline (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="class_time" placeholder="class_time (like 08:00:20)"></div>
						<div class="form-group"><input type="text" class="form-control" name="id_group" placeholder="id_group (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="id_teacher" placeholder="id_teacher (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="id_discipline" placeholder="id_discipline (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="id_classroom" placeholder="id_classroom (int)"></div>
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
						<th>Дата занятия</th>
						<th>Количество дисциплин</th>
						<th>Время занятия</th>
						<th>id группы</th>
						<th>id преподавателя</th>
						<th>id дисциплины</th>
						<th>id кабинета</th>
					</tr>
					<?php foreach ($result as $value) { ?>
					<tr>
						<td><?=$value['class_data'] ?></td>
						<td><?=$value['number_of_discipline'] ?></td>
						<td><?=$value['class_time'] ?></td>
						<td><?=$value['id_group'] ?></td>
						<td><?=$value['id_teacher'] ?></td>
						<td><?=$value['id_discipline'] ?></td>
						<td><?=$value['id_classroom'] ?></td>
					</tr> <?php } ?>
				</thead>
			</table>
		</div>
	</body>
</html>

<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["del_btn"])) {
             $result = $pdo->query("DELETE from $table where class_data='$_POST[id]'");
         }

         if (isset($_POST["add_btn"])) {
             $result = $pdo->query("INSERT into $table (class_data, number_of_discipline, class_time, id_group, id_teacher, id_discipline, id_classroom) values (
            '$_POST[class_data]',
            '$_POST[number_of_discipline]',
            '$_POST[class_time]', 
            '$_POST[id_group]', 
            '$_POST[id_teacher]',
         	'$_POST[id_discipline]',
         	'$_POST[id_classroom]',)");
         }

         if (isset($_POST["edit_btn"])) {
             $result = $pdo->query("UPDATE $table set number_of_discipline='$_POST[number_of_discipline]',
              class_time='$_POST[class_time]',
              id_group='$_POST[id_group]',
              id_teacher='$_POST[id_teacher]',
              id_discipline='$_POST[id_discipline]', id_classroom='$_POST[id_classroom]' where class_data='$_POST[class_data]'");
         }

         echo "<meta http-equiv='refresh' content='0'>";
     }


?>