<?php

$dbuser = 'postgres';
$dbpass = 'admin';
$pdo = new PDO("pgsql:host='localhost';dbname='college'", $dbuser, $dbpass);
$result = $pdo->query("SELECT * FROM teacher ORDER BY id_teacher");
$table = "public.teacher";
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
					<h2>Teacher</h2>
					<p></p>
					<form class="form-row" method="post" action="teacher.php">
						 <div class="form-group"><input type="text" class="form-control" name="id" placeholder="Введите id"></div>
						 <div class="form-group"><input type="submit" name="del_btn" class="btn btn-outline-danger" value="Удалить"/></div>
					</form>	
					<hr>				
					<form method="post">
						<div class="form-group"><input type="text" class="form-control" name="id_teacher" placeholder="id_teacher (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="surname" placeholder="surname (text)"></div>
						<div class="form-group"><input type="text" class="form-control" name="work_experience" placeholder="work_experience (text)"></div>
						<div class="form-group"><input type="text" class="form-control" name="education" placeholder="education (text)"></div>
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
						<th>Опыт работы</th>
						<th>Образование</th>
					</tr>
					<?php foreach ($result as $value) { ?>
					<tr>
						<td><?=$value['id_teacher'] ?></td>
						<td><?=$value['surname'] ?></td>
						<td><?=$value['work_experience'] ?></td>
						<td><?=$value['education'] ?></td>
					</tr> <?php } ?>
				</thead>
			</table>
		</div>
	</body>
</html>

<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["del_btn"])) {
             $result = $pdo->query("DELETE from $table where id_teacher='$_POST[id]'");
         }

         if (isset($_POST["add_btn"])) {
             $result = $pdo->query("INSERT into $table (id_teacher, surname, work_experience, education) values (
            '$_POST[id_teacher]',
            '$_POST[surname]',
            '$_POST[work_experience]', 
            '$_POST[education]')");
         }

         if (isset($_POST["edit_btn"])) {
             $result = $pdo->query("UPDATE $table set surname='$_POST[surname]',
              work_experience='$_POST[work_experience]',
              education='$_POST[education]' where id_teacher='$_POST[id_teacher]'");
         }

         echo "<meta http-equiv='refresh' content='0'>";
     }


?>