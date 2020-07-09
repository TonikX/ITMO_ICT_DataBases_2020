<?php

$dbuser = 'postgres';
$dbpass = '123';
$host = 'localhost';
$dbname='postgres';
$pdo = new PDO("pgsql:host=$host; dbname=$dbname", $dbuser, $dbpass);
$result = $pdo->query('SELECT * FROM l_e."Bureau"');

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
						      <li class="nav-item">
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
						      <li class="nav-item active">
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
					<h2>Бюро</h2>
					<p></p>
					<form class="form-row" method="post" action="bureau.php">
						 <div class="form-group"><input type="text" class="form-control" name="id" placeholder="Введите id"></div>
						 <div class="form-group"><input type="submit" name="del_btn" class="btn btn-outline-danger" value="Удалить"/></div>
					</form>	
					<hr>				
					<form method="post">
						<div class="form-group"><input type="text" class="form-control" name="ID__bureau" placeholder="ID__bureau (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="Organization_name" placeholder="Organization_name (str)"></div>
						<div class="form-group"><input type="text" class="form-control" name="Address" placeholder="Address (str)"></div>
						<div class="form-group"><input type="text" class="form-control" name="ID_job_openings" placeholder="ID_job_openings (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="FCS_employer" placeholder="FCS_employer (str)"></div>
						<div class="form-group"><input type="text" class="form-control" name="ID_directory" placeholder="ID_directory (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="ID_course" placeholder="ID_course (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="ID_employer" placeholder="ID_employer (int)"></div>
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
						<th>ID__bureau</th>
						<th>Organization_name</th>
						<th>Address</th>
						<th>ID_job_openings</th>
						<th>FCS_employer</th>
						<th>ID_directory</th>
						<th>ID_course</th>
						<th>ID_employer</th>
					</tr>
					<?php foreach ($result as $value) { ?>
					<tr>
						<td><?=$value['ID__bureau'] ?></td>
						<td><?=$value['Organization_name'] ?></td>
						<td><?=$value['Address'] ?></td>
						<td><?=$value['ID_job_openings'] ?></td>
						<td><?=$value['FCS_employer'] ?></td>
						<td><?=$value['ID_directory'] ?></td>
						<td><?=$value['ID_course'] ?></td>
						<td><?=$value['ID_employer'] ?></td>
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
             $result = $pdo->query("DELETE from l_e.\"Bureau\" where \"Bureau\".\"ID__bureau\"='$_POST[id]'");
         }

         if (isset($_POST["add_btn"])) {
             $result = $pdo->query("INSERT into l_e.\"Bureau\" (\"ID__bureau\", \"Organization_name\", \"Address\", \"ID_job_openings\", \"FCS_employer\", \"ID_directory\", \"ID_course\", \"ID_employer\") values (
            '$_POST[ID__bureau]',
            '$_POST[Organization_name]',
            '$_POST[Address]', 
            '$_POST[ID_job_openings]', 
            '$_POST[FCS_employer]', 
            '$_POST[ID_directory]', 
            '$_POST[ID_course]',
         	'$_POST[ID_employer]')");
         }

         if (isset($_POST["edit_btn"])) {
             $result = $pdo->query("UPDATE l_e.\"Bureau\" set \"Organization_name\"='$_POST[Organization_name]',
             \"Address\"='$_POST[Address]',
             \"ID_job_openings\"='$_POST[ID_job_openings]',
             \"FCS_employer\"='$_POST[FCS_employer]',
             \"ID_directory\"='$_POST[ID_directory]',
             \"ID_course\"='$_POST[ID_course]',
             \"ID_employer\"='$_POST[ID_employer]' where \"Bureau\".\"ID__bureau\"='$_POST[ID__bureau]'");
         }

         echo "<meta http-equiv='refresh' content='0'>";
     }
?>
