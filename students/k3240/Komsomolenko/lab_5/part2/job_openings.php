<?php

$dbuser = 'postgres';
$dbpass = '123';
$host = 'localhost';
$dbname='postgres';
$pdo = new PDO("pgsql:host=$host; dbname=$dbname", $dbuser, $dbpass);
$result = $pdo->query('SELECT * FROM l_e."Job_openings"');

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
						      <li class="nav-item active">
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
					<h2>Вакансии</h2>
					<p></p>
					<form class="form-row" method="post" action="job_openings.php">
						 <div class="form-group"><input type="text" class="form-control" name="id" placeholder="Введите id"></div>
						 <div class="form-group"><input type="submit" name="del_btn" class="btn btn-outline-danger" value="Удалить"/></div>
					</form>	
					<hr>				
					<form method="post">
						<div class="form-group"><input type="text" class="form-control" name="ID_job_openings" placeholder="ID_job_openings (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="Salary" placeholder="Salary (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="Qualification" placeholder="Qualification (str)"></div>
						<div class="form-group"><input type="text" class="form-control" name="Details" placeholder="Details (str)"></div>
						<div class="form-group"><input type="text" class="form-control" name="Type_job" placeholder="Type_job (str)"></div>
						<div class="form-group"><input type="text" class="form-control" name="Date_publication" placeholder="Date_publication (date)"></div>
						<div class="form-group"><input type="text" class="form-control" name="Working_conditions"
						placeholder="Working_conditions (str)"></div>
						<div class="form-group"><input type="text" class="form-control" name="Job_status" placeholder="Job_status (str)"></div>
						<div class="form-group"><input type="text" class="form-control" name="Work_experience" placeholder="Work_experience (str)"></div>
						<div class="form-group"><input type="text" class="form-control" name="Discharge" placeholder="Discharge (str)"></div>
						<div class="form-group"><input type="text" class="form-control" name="ID_employer" placeholder="ID_employer (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="FCS_employer" placeholder="FCS_employer (str)"></div>
						<div class="form-group"><input type="text" class="form-control" name="ID_course" placeholder="ID_course (int)"></div>
						<div class="form-group"><input type="text" class="form-control" name="ID_directory" placeholder="ID_directory (int)"></div>
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
						<th>ID_job_openings</th>
						<th>Salary</th>
						<th>Qualification</th>
						<th>Details</th>
						<th>Type_job</th>
						<th>Date_publication</th>
						<th>Working_conditions</th>
						<th>Job_status</th>
						<th>Work_experience</th>
						<th>Qualification</th>
						<th>Details</th>
						<th>FCS_employer</th>
						<th>ID_course</th>
						<th>ID_directory</th>
					</tr>
					<?php foreach ($result as $value) { ?>
					<tr>
						<td><?=$value['ID_job_openings'] ?></td>
						<td><?=$value['Salary'] ?></td>
						<td><?=$value['Qualification'] ?></td>
						<td><?=$value['Details'] ?></td>
						<td><?=$value['Type_job'] ?></td>
						<td><?=$value['Date_publication'] ?></td>
						<td><?=$value['Working_conditions'] ?></td>
						<td><?=$value['Job_status'] ?></td>
						<td><?=$value['Work_experience'] ?></td>
						<td><?=$value['Discharge'] ?></td>
						<td><?=$value['ID_employer'] ?></td>
						<td><?=$value['FCS_employer'] ?></td>
						<td><?=$value['ID_course'] ?></td>
						<td><?=$value['ID_directory'] ?></td>
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
             $result = $pdo->query("DELETE from l_e.\"Job_openings\" where \"Job_openings\".\"ID_job_openings\"='$_POST[id]'");
         }

         if (isset($_POST["add_btn"])) {
             $result = $pdo->query("INSERT into l_e.\"Job_openings\" (\"ID_job_openings\", \"Salary\", \"Qualification\", \"Details\", \"Type_job\", \"Date_publication\", \"Working_conditions\", \"Job_status\", \"Work_experience\", \"Discharge\", \"ID_employer\", \"FCS_employer\", \"ID_course\", \"ID_directory\") values (
            '$_POST[ID_job_openings]',
            '$_POST[Salary]',
            '$_POST[Qualification]', 
            '$_POST[Details]', 
            '$_POST[Type_job]', 
            '$_POST[Date_publication]', 
         	'$_POST[Working_conditions]',
         	'$_POST[Job_status]',
            '$_POST[Work_experience]',
            '$_POST[Discharge]', 
            '$_POST[ID_employer]', 
            '$_POST[FCS_employer]', 
         	'$_POST[ID_course]', 
            '$_POST[ID_directory]')");
         }

         if (isset($_POST["edit_btn"])) {
             $result = $pdo->query("UPDATE l_e.\"Job_openings\" set \"Salary\"='$_POST[Salary]',
             \"Qualification\"='$_POST[Qualification]',
             \"Details\"='$_POST[Details]',
             \"Type_job\"='$_POST[Type_job]',
             \"Date_publication\"='$_POST[Date_publication]',
             \"Working_conditions\"='$_POST[Working_conditions]',
             \"Job_status\"='$_POST[Job_status]',
             \"Work_experience\"='$_POST[Work_experience]',
             \"Discharge\"='$_POST[Discharge]',
             \"ID_employer\"='$_POST[ID_employer]',
             \"FCS_employer\"='$_POST[FCS_employer]',
             \"ID_course\"='$_POST[ID_course]',
             \"ID_directory\"='$_POST[ID_directory]' where \"Job_openings\".\"ID_job_openings\"='$_POST[ID_job_openings]'");
         }

         echo "<meta http-equiv='refresh' content='0'>";
     }
?>