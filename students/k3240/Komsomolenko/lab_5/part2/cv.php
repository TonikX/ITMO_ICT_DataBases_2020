<?php

$dbuser = 'postgres';
$dbpass = '123';
$host = 'localhost';
$dbname='postgres';
$pdo = new PDO("pgsql:host=$host; dbname=$dbname", $dbuser, $dbpass);
$result = $pdo->query('SELECT * FROM l_e."CV"');

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
						      <li class="nav-item active">
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
					<h2>Резюме</h2>
					<p></p>
					<form class="form-row" method="post" action="CV.php">
						 <div class="form-group"><input type="text" class="form-control" name="id" placeholder="Введите id"></div>
						 <div class="form-group"><input type="submit" name="del_btn" class="btn btn-outline-danger" value="Удалить"/></div>
					</form>	
					<hr>				
					<form method="post">
						<div class="form-group"><input type="text" class="form-control" name="ID_CV" placeholder="ID_CV (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="FCS_applicant" placeholder="FCS_applicant (str)"></div>
						<div class="form-group"><input type="text" class="form-control" name="ID_job_openings" placeholder="ID_job_openings (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="ID_employer" placeholder="ID_employer (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="FCS_employer" placeholder="FCS_employer (str)"></div>
						<div class="form-group"><input type="text" class="form-control" name="ID_directory" placeholder="ID_directory (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="ID_applicant" placeholder="ID_applicant (int)"></div>
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
						<th>ID_CV</th>
						<th>FCS_applicant</th>
						<th>ID_job_openings</th>
						<th>ID_employer</th>
						<th>FCS_employer</th>
						<th>ID_directory</th>
						<th>ID_applicant</th>
					</tr>
					<?php foreach ($result as $value) { ?>
					<tr>
						<td><?=$value['ID_CV'] ?></td>
						<td><?=$value['FCS_applicant'] ?></td>
						<td><?=$value['ID_job_openings'] ?></td>
						<td><?=$value['ID_employer'] ?></td>
						<td><?=$value['FCS_employer'] ?></td>
						<td><?=$value['ID_directory'] ?></td>
						<td><?=$value['ID_applicant'] ?></td>
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
             $result = $pdo->query("DELETE from l_e.\"CV\" where \"CV\".\"ID_CV\"='$_POST[id]'");
         }

         if (isset($_POST["add_btn"])) {
             $result = $pdo->query("INSERT into l_e.\"CV\" (\"ID_CV\", \"FCS_applicant\", \"ID_job_openings\", \"ID_employer\", \"FCS_employer\", \"ID_directory\", \"ID_applicant\") values (
            '$_POST[ID_CV]',
            '$_POST[FCS_applicant]',
            '$_POST[ID_job_openings]', 
            '$_POST[ID_employer]', 
            '$_POST[FCS_employer]', 
            '$_POST[ID_directory]', 
         	'$_POST[ID_applicant]')");
         }

         if (isset($_POST["edit_btn"])) {
             $result = $pdo->query("UPDATE l_e.\"CV\" set \"FCS_applicant\"='$_POST[FCS_applicant]',
             \"ID_job_openings\"='$_POST[ID_job_openings]',
             \"ID_employer\"='$_POST[ID_employer]',
             \"FCS_employer\"='$_POST[FCS_employer]',
             \"ID_directory\"='$_POST[ID_directory]',
             \"ID_applicant\"='$_POST[ID_applicant]' where \"CV\".\"ID_CV\"='$_POST[ID_CV]'");
         }

         echo "<meta http-equiv='refresh' content='0'>";
     }
?>