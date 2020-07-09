<?php

	echo "<h1>Запросы из Лабораторной работы #4<h1>";

  $link_address1 = 'index.php';
	echo "<a href='$link_address1'>Вернуться обратно</a>";

	$host = "localhost";
	$dbname = "itmo";
	$dbuser = "postgres";
	$dbpass = "811712Andrey";
	$db = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);

  $query1 = "SELECT sbj.name from public.schedule sch
			 JOIN public.discipline dis ON dis.id_discipline = sch.id_discipline
			 JOIN public.subject sbj ON sbj.id_subject = dis.id_subject
			 WHERE order_class = '3' AND date = '2020-04-20'";

  $query2 = 'select cl.id_class, cl.id_Teacher, cl.begining_education, cl.end_education, st.first_name, st.last_name, jr.mark, sub.name
			 from public.class cl 
			 join public.student st ON st.id_class = cl.id_class
			 join public.journal jr ON st.id_class = cl.id_class
			 join public.discipline dis on jr.id_discipline = dis.id_discipline
			 join public.subject sub on dis.id_subject = sub.id_subject
			 order by cl."id_class"';

  $query3 = "SELECT first_name, last_name
			 FROM public.teacher tch
			 JOIN public.cabinet cab ON cab.id_cabinet = tch.id_cabinet
			 WHERE cab.floor = '1'";

  $query4 = "SELECT name FROM public.class
			 WHERE end_education BETWEEN '2025-01-01' AND '2025-12-31'";

  $query5 = "SELECT id_cabinet, floor from public.cabinet
			 GROUP by floor, id_cabinet HAVING floor > 1";

  $result1 = $db->query($query1);
  $result2 = $db->query($query2);
  $result3 = $db->query($query3);
  $result4 = $db->query($query4);
  $result5 = $db->query($query5);

	// table style

  echo '<html>';
  echo '<head>
       <style>
  table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  table-layout: fixed;
  }
  td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 12px;
  }
  tr:hover {background-color: #ddd;}
  </style>
  </head>';

// query 1

echo "<br/>" . "<h2>Запрос 1: Какой предмет будет на 3 уроке в заданном классе 20 апреля 2020 года ?</h2> ";

  echo '<body>
	<table>
		<tr>
			<th>name_subject</th>
		</tr>';

	foreach ($result1 as $row) {
    echo '<tr>';
		echo '<td>' . $row['name'] . '</td>';
    echo '</tr>';
	}
  echo '</table></body></html>';


// query 2

echo "<br/>" . "<h2>Запрос 2: Вывести имена и оценки учеников всех классов школы?</h2>";

  echo '<body>
	<table>
		<tr>
			<th>begining_education</th>
			<th>end_education</th>
			<th>first_name</th>
			<th>last_name</th>
			<th>mark</th>
			<th>name</th>
		</tr>';

	foreach ($result2 as $row) {
    echo '<tr>';
		echo '<td>' . $row['begining_education'] . '</td>';
		echo '<td>' . $row['end_education'] . '</td>';
		echo '<td>' . $row['first_name'] . '</td>';
		echo '<td>' . $row['last_name'] . '</td>';
		echo '<td>' . $row['mark'] . '</td>';
		echo '<td>' . $row['name'] . " " . '</td>';
    echo '</tr>';
	}
  echo '</table></body></html>';


// query 3

echo "<br/>" . "<h2>Запрос 3: Имена учителей, у которых личные кабинеты находятся на 1 этаже?</h2>";

  echo '<body>
	<table>
		<tr>
			<th>first_name</th>
			<th>last_name</th>
		</tr>';

	foreach ($result3 as $row) {
    echo '<tr>';
		echo '<td>' . $row['first_name'] . '</td>';
		echo '<td>' . $row['last_name'] . " " . '</td>';
    echo '</tr>';
	}
  echo '</table></body></html>';


// query 4

echo "<br/>" . "<h2>Запрос 4: У каких классов будут выпускные в 2025 году?</h2>";

  echo '<body>
	<table>
		<tr>
			<th>name</th>
		</tr>';

	foreach ($result4 as $row) {
    echo '<tr>';
		echo '<td>' . $row['name'] . '</td>';
    echo '</tr>';
	}
  echo '</table></body></html>';


// query 5

echo "<br/>" . "<h2>Запрос 5: Номера кабинетов, которые находятся выше 1 этажа.?</h2>";

  echo '<body>
	<table>
		<tr>
			<th>id_cabinet</th>
			<th>floor</th>
		</tr>';

	foreach ($result5 as $row) {
    echo '<tr>';
		echo '<td>' . $row['id_cabinet'] . '</td>';
		echo '<td>' . $row['floor'] . " " . '</td>';
    echo '</tr>';
	}
  echo '</table></body></html>';