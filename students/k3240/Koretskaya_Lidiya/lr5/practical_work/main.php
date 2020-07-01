<?php

$dbuser = 'postgres';
$dbpass = 'admin';
$pdo = new PDO("pgsql:host='localhost';dbname='college'", $dbuser, $dbpass);

$a1 = "Объединить столбцы фамилия и образование из таблицы преподаватель посредством строки  'получил/а образование в':";
$q1= "SELECT concat (surname, ' получил/а образование в ', education) as result from teacher";

$a2 = "Выбрать те пары, которые начинаются позже 7, но раньше 12:";
$q2 = "SELECT class_time from timetable where date_part('hour', class_time)>7 and date_part('hour', class_time)<12  ";

$a3 = "Вывести фамилии преподавателей, которые читают хоть одну лекцию:";
$q3 = "SELECT surname from teacher where exists (select * from timetable where timetable.id_teacher = teacher.id_teacher) ";

$a4 = "Вывести даты занятий и кто их ведет:";
$q4 = "SELECT class_data, surname from timetable inner join teacher on timetable.id_teacher = teacher.id_teacher ";

$a5 = "Вывести объединение строк таблицы студенты, в которых выполняется какое-либо из условий: фамилия студента Иванов, год выпуска студента больше 2000:";
$q5 = "SELECT surname, year_of_receipt from student where year_of_receipt>2000 union select surname, year_of_receipt from student where surname='Ivanov'";

$q = array($q1, $q2, $q3, $q4, $q5);
$a = array($a1, $a2, $a3, $a4, $a5);
?>

<!DOCTYPE html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<h2>Tables</h2>
			<div class="row">
				<form action="student.php">
	   				<button class="btn btn-light">Student</button>
	   			</form></br>
	   			<form action="classroom.php">
	   				<button class="btn btn-light">Classroom</button>
	   			</form></br>
	   			<form action="classroom_for_teacher.php">
	   				<button class="btn btn-light">Classroom for teacher</button>
	   			</form></br>
	   			<form action="discipline.php">
	   				<button class="btn btn-light">Discipline</button>
	   			</form></br>
	   			<form action="group.php">
	   				<button class="btn btn-light">Group</button>
	   			</form></br>
	   			<form action="teacher.php">
	   				<button class="btn btn-light">Teacher</button>
	   			</form></br>
	   			<form action="teaching.php">
	   				<button class="btn btn-light">Teaching</button>
	   			</form></br>
	   			<form action="timetable.php">
	   				<button class="btn btn-light">Timetable</button>
			</div>
			<h2>Queries</h2>
			
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
	</body>
</html>
