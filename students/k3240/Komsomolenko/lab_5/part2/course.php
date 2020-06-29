<?php

$dbuser = 'postgres';
$dbpass = '123';
$host = 'localhost';
$dbname='postgres';
$pdo = new PDO("pgsql:host=$host; dbname=$dbname", $dbuser, $dbpass);
$result = $pdo->query('SELECT * FROM l_e."Course"');

?>

<!DOCTYPE html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<style type="text/css">
		html,
		body,
		header,
		.intro-2 {
		    background-size: cover;
		    background-color: white;
		}
		.navbar {
		    z-index: 1;
		    background-color: rgba(0,0,0,0.92);
		}
		.container-fluid{
			padding-right: 0;
			padding-left: 0;
			margin-bottom: 1em;
		}
		html,
		body,
		header,
		.view {
		  height: 100%;
		}
		</style>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="container-fluid">
					<nav class="navbar navbar-expand-lg navbar-dark black rgba-black-strong">
						<div class="container">
						  <a class="navbar-brand" href="main.php"><strong>Комсомоленко Владислав</strong></a>
						  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
						    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						    <span class="navbar-toggler-icon"></span>
						  </button>
						  <div class="collapse navbar-collapse" id="navbarSupportedContent">
						    <ul class="navbar-nav mr-auto">
						      <li class="nav-item">
						        <a class="nav-link" href="applicant.php">Соискатель</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="cv.php">Резюме</a>
						      </li>
						      <li class="nav-item active">
						        <a class="nav-link" href="course.php">Курс</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="directory_professions.php">Справочник профессий</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="employers.php">Работодатели</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="job_openings.php">Вакансии</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="bureau.php">Бюро</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="training_center.php">Учебный центр</a>
						      </li>
						    </ul>
						  </div>
						</div>
					</nav>
	   			</div>
			</div>
			<div class="view intro-2">
			<div class="full-bg-img">
			  <div class="mask rgba-black-strong flex-center">
			    <div class="container">
			      <div class="white-text wow fadeInUp">
					<h2>Kypc</h2>
					<p></p>
					<form class="form-row" method="post" action="course.php">
						 <div class="form-group"><input type="text" class="form-control" name="id" placeholder="Введите id"></div>
						 <div class="form-group"><input type="submit" name="del_btn" class="btn btn-outline-danger" value="Удалить"/></div>
					</form>	
					<hr>				
					<form method="post">
						<div class="form-group"><input type="text" class="form-control" name="ID_course" placeholder="ID_course (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="New_discharge" placeholder="New_discharge (str)"></div>
						<div class="form-group"><input type="text" class="form-control" name="Duration" placeholder="Duration (time)"></div>
						<div class="form-group"><input type="text" class="form-control" name="Price" placeholder="Price (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="Group_number" placeholder="Group_number (str)"></div>
						<div class="form-group"><input type="text" class="form-control" name="Students_list" placeholder="Students_list (str)"></div>
						<input type="submit" name="add_btn"
				           class="btn btn-outline-success" value="Добавить"/>
				         <input type="submit" name="edit_btn"
				           class="btn btn-outline-info" value="Редактировать"/>
					</form>
				</div>
			</div><p></p>

   			<table class="table">
				<thead class="thead-lightlight">
					<tr>
						<th>ID_course</th>
						<th>New_discharge</th>
						<th>Duration</th>
						<th>Price</th>
						<th>Group_number</th>
						<th>Students_list</th>
					</tr>
					<?php foreach ($result as $value) { ?>
					<tr>
						<td><?=$value['ID_course'] ?></td>
						<td><?=$value['New_discharge'] ?></td>
						<td><?=$value['Duration'] ?></td>
						<td><?=$value['Price'] ?></td>
						<td><?=$value['Group_number'] ?></td>
						<td><?=$value['Students_list'] ?></td>
					</tr> <?php } ?>
				</thead>
			</table>
					
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</body>
</html>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["del_btn"])) {
             $result = $pdo->query("DELETE from l_e.\"Course\" where \"Course\".\"ID_course\"='$_POST[id]'");
         }

         if (isset($_POST["add_btn"])) {
             $result = $pdo->query("INSERT into l_e.\"Course\" (\"ID_course\", \"New_discharge\", \"Duration\", \"Price\", \"Group_number\", \"Students_list\") values (
            '$_POST[ID_course]',
            '$_POST[New_discharge]',
            '$_POST[Duration]', 
            '$_POST[Price]', 
            '$_POST[Group_number]',
         	'$_POST[Students_list]')");
         }

         if (isset($_POST["edit_btn"])) {
             $result = $pdo->query("UPDATE l_e.\"Course\" set \"New_discharge\"='$_POST[New_discharge]',
             \"Duration\"='$_POST[Duration]',
             \"Price\"='$_POST[Price]',
             \"Group_number\"='$_POST[Group_number]',
             \"Students_list\"='$_POST[Students_list]' where \"Course\".\"ID_course\"='$_POST[ID_course]'");
         }

         echo "<meta http-equiv='refresh' content='0'>";
     }
?>
