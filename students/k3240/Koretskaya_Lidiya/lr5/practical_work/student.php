<?php

$dbuser = 'postgres';
$dbpass = 'admin';
$pdo = new PDO("pgsql:host='localhost';dbname='college'", $dbuser, $dbpass);
$result = $pdo->query("SELECT * FROM student ORDER BY id_student");
$table = "public.student";
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
					<h2>Student</h2>
					<p></p>
					<form class="form-row" method="post" action="student.php">
						 <div class="form-group"><input type="text" class="form-control" name="id" placeholder="Введите id"></div>
						 <div class="form-group"><input type="submit" name="del_btn" class="btn btn-outline-danger" value="Удалить"/></div>
					</form>	
					<hr>				
					<form method="post">
						<div class="form-group"><input type="text" class="form-control" name="id_student" placeholder="id_student (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="surname" placeholder="surname (text)"></div>
						<div class="form-group"><input type="text" class="form-control" name="year_of_receipt" placeholder="year_of_receipt (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="attendance" placeholder="attendance (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="academic_performance" placeholder="academic_performance (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="id_group" placeholder="id_group (int)"></div>
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
						<th>Год поступления</th>
						<th>Посещаемость</th>
						<th>Успеваемость</th>
						<th>id группы</th>
					</tr>
					<?php foreach ($result as $value) { ?>
					<tr>
						<td><?=$value['id_student'] ?></td>
						<td><?=$value['surname'] ?></td>
						<td><?=$value['year_of_receipt'] ?></td>
						<td><?=$value['attendance'] ?></td>
						<td><?=$value['academic_performance'] ?></td>
						<td><?=$value['id_group'] ?></td>
					</tr> <?php } ?>
				</thead>
			</table>
		</div>
	</body>
</html>

<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["del_btn"])) {
             $result = $pdo->query("DELETE from $table where id_student='$_POST[id]'");
         }

         if (isset($_POST["add_btn"])) {
             $result = $pdo->query("INSERT into $table (id_student, surname, year_of_receipt, attendance, academic_performance, id_group) values (
            '$_POST[id_student]',
            '$_POST[surname]',
            '$_POST[year_of_receipt]', 
            '$_POST[attendance]', 
            '$_POST[academic_performance]',
         	'$_POST[id_group]')");
         }

         if (isset($_POST["edit_btn"])) {
             $result = $pdo->query("UPDATE $table set surname='$_POST[surname]',
              year_of_receipt='$_POST[year_of_receipt]',
              attendance='$_POST[attendance]',
              academic_performance='$_POST[academic_performance]',
              id_group='$_POST[id_group]' where id_student='$_POST[id_student]'");
         }

         echo "<meta http-equiv='refresh' content='0'>";
     }


?>