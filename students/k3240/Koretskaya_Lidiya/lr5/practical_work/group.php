<?php

$dbuser = 'postgres';
$dbpass = 'admin';
$pdo = new PDO("pgsql:host='localhost';dbname='college'", $dbuser, $dbpass);
$result = $pdo->query("SELECT * FROM public.group ORDER BY id_group");
$table = "public.group";
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
					<h2>Group</h2>
					<p></p>
					<form class="form-row" method="post" action="group.php">
						 <div class="form-group"><input type="text" class="form-control" name="id" placeholder="Введите id"></div>
						 <div class="form-group"><input type="submit" name="del_btn" class="btn btn-outline-danger" value="Удалить"/></div>
					</form>	
					<hr>				
					<form method="post">
						<div class="form-group"><input type="text" class="form-control" name="id_group" placeholder="id_group (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="number_of_students" placeholder="number_of_students (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="course" placeholder="course (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="specialization" placeholder="specialization (text)"></div>
						<div class="form-group"><input type="text" class="form-control" name="faculty" placeholder="faculty (text)"></div>
						<div class="form-group"><input type="text" class="form-control" name="average_performance" placeholder="average_performance (int)"></div>
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
						<th>Число студентов</th>
						<th>Курс</th>
						<th>Специализация</th>
						<th>Факультет</th>
						<th>Средняя успеваемость</th>
					</tr>
					<?php foreach ($result as $value) { ?>
					<tr>
						<td><?=$value['id_group'] ?></td>
						<td><?=$value['number_of_students'] ?></td>
						<td><?=$value['course'] ?></td>
						<td><?=$value['specialization'] ?></td>
						<td><?=$value['faculty'] ?></td>
						<td><?=$value['average_performance'] ?></td>
					</tr> <?php } ?>
				</thead>
			</table>
		</div>
	</body>
</html>

<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["del_btn"])) {
             $result = $pdo->query("DELETE from $table where id_group='$_POST[id]'");
         }

         if (isset($_POST["add_btn"])) {
             $result = $pdo->query("INSERT into $table (id_group, number_of_students, course, specialization, faculty, average_performance) values (
            '$_POST[id_group]',
            '$_POST[number_of_students]',
            '$_POST[course]', 
            '$_POST[specialization]', 
            '$_POST[faculty]',
         	'$_POST[average_performance]')");
         }

         if (isset($_POST["edit_btn"])) {
             $result = $pdo->query("UPDATE $table set number_of_students='$_POST[number_of_students]',
              course='$_POST[course]',
              specialization='$_POST[specialization]',
              faculty='$_POST[faculty]',
              average_performance='$_POST[average_performance]' where id_group='$_POST[id_group]'");
         }

         echo "<meta http-equiv='refresh' content='0'>";
     }


?>