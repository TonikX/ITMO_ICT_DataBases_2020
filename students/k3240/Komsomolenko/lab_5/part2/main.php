<?php

$dbuser = 'postgres';
$dbpass = '123';
$host = 'localhost';
$dbname='postgres';
$pdo = new PDO("pgsql:host=$host; dbname=$dbname", $dbuser, $dbpass);

$a1 = "1. Вывод списка студентов и списка курсов отсортированного по стоимости:";
$q1= 'SELECT "Course"."Students_list", "Directory_professions"."Course_list" FROM l_e."Course", l_e."Directory_professions" WHERE "Course"."ID_course" = "Directory_professions"."ID_course" ORDER BY "Price"';

$a2 = "2. Выводим ФИО заявителей женского пола:";
$q2 = 'SELECT "FCS_applicant" FROM l_e."Applicant" WHERE "Sex" = (SELECT "Sex" FROM l_e."Applicant" WHERE "Applicant"."Sex" = \'F\')';

$a3 = "3. Вывод ФИО заявителей с предыдущей зарплатой больше 30000:";
$q3 = 'SELECT "FCS_applicant" FROM l_e."Applicant" WHERE "Last_salary" = (SELECT "Last_salary" FROM l_e."Applicant" WHERE "Applicant"."Last_salary" > 30000)';

$a4 = "4. Вывод ФИО и название организаций, в которых фамилия короче 7 букв:";
$q4 = 'SELECT "FCS_employer", "Organization_name" FROM l_e."Employers" GROUP BY "FCS_employer", "Organization_name" HAVING LENGTH("FCS_employer")< 12';

$a5 = "5. Вывод ФИО заявителя и количество курсов, которые он может оплатить на предыдущую зарплату:";
$q5 = 'SELECT "Applicant"."FCS_applicant", CAST("Applicant"."Last_salary" as FLOAT) / CAST("Course"."Price" as FLOAT) FROM l_e."Applicant" INNER JOIN l_e."Course" ON "Applicant"."ID_applicant"="Course"."ID_course"';

$q = array($q1, $q2, $q3, $q4, $q5);
$a = array($a1, $a2, $a3, $a4, $a5);

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
			      	<h2>Запросы из 4 лабы: </h2>
					<?php 
						for ($i=0; $i < 5; $i++) { 
						echo "<p>".$a[$i]."<p>";
						$result = $pdo->query($q[$i]);
						foreach ($result as $data) {
							$p = 0;
							while ($p != $result->columnCount()) { 
							print_r($data[$p]." ");
							$p+=1;
 						}
						echo "</br>";}
					}
					?>
					</p>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</body>
</html>
