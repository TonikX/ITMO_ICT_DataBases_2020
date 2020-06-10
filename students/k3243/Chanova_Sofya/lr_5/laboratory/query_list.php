<?php

	echo "<h1>list of queries from lab 4<h1>";

  $link_address1 = 'index.php';
	echo "<a href='$link_address1'>to main</a>";

	$host = "localhost";
	$dbname = "college";
	$dbuser = "postgres";
	$dbpass = "postgres";
	$db = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);

  $query1 = "SELECT name_subject, weekday
             FROM college.schedule sch
             INNER JOIN college.subject sub ON sub.id_subject = sch.id_subject
             WHERE weekday = 'Tuesday' AND number_group = 203";

  $query2 = "SELECT DISTINCT sc.number_group, full_name_teacher
             FROM college.teacher te
             INNER JOIN college.schedule sc ON sc.id_teacher = te.id_teacher
             WHERE sc.number_group = 102";

  $query3 = "SELECT DISTINCT tea.full_name_teacher, sub.name_subject, number_group
             FROM college.schedule sch
             INNER JOIN college.teacher tea ON tea.id_teacher = sch.id_teacher
             INNER JOIN college.subject sub ON sub.id_subject = sch.id_subject
             WHERE tea.full_name_teacher = 'Lobachevsky Nikolai Ivanovitch'
             AND sub.name_subject = 'Math'";

  $query4 = "SELECT number_group, sch.weekday, sch.number_classroom, sub.name_subject
             FROM college.schedule sch
             INNER JOIN college.subject sub ON sub.id_subject = sch.id_subject
             WHERE number_group = '102'
						 AND sch.weekday = 'Thursday'";

  $query5 = "SELECT number_course, COUNT(id_student)
             FROM college.student st
             INNER JOIN college.group gr ON gr.number_group = st.number_group
             INNER JOIN college.schedule sch ON sch.number_group = gr.number_group
             WHERE number_classroom = 10
             GROUP BY number_course;";

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

echo "<br/>" . "<h2>запрос 1: Какой предмет будет
                в заданной группе в заданный день недели?</h2> ";

  echo '<body>
	<table>
		<tr>
			<th>name_subject</th>
			<th>weekday</th>
		</tr>';

	foreach ($result1 as $row) {
    echo '<tr>';
		echo '<td>' . $row['name_subject'] . '</td>';
		echo '<td>' . $row['weekday'] . " " . '</td>';
    echo '</tr>';
	}
  echo '</table></body></html>';


// query 2

echo "<br/>" . "<h2>запрос 2: Кто из преподавателей
                преподает в заданной группе?</h2>";

  echo '<body>
	<table>
		<tr>
			<th>number_group</th>
			<th>full_name_teacher</th>
		</tr>';

	foreach ($result2 as $row) {
    echo '<tr>';
		echo '<td>' . $row['number_group'] . '</td>';
		echo '<td>' . $row['full_name_teacher'] . " " . '</td>';
    echo '</tr>';
	}
  echo '</table></body></html>';


// query 3

echo "<br/>" . "<h2>запрос 3: В каких группах преподает
                заданный предмет заданный преподаватель?</h2>";

  echo '<body>
	<table>
		<tr>
			<th>full_name_teacher</th>
			<th>name_subject</th>
      <th>number_group</th>
		</tr>';

	foreach ($result3 as $row) {
    echo '<tr>';
		echo '<td>' . $row['full_name_teacher'] . '</td>';
		echo '<td>' . $row['name_subject'] . " " . '</td>';
    echo '<td>' . $row['number_group'] . " " . '</td>';
    echo '</tr>';
	}
  echo '</table></body></html>';


// query 4

echo "<br/>" . "<h2>запрос 4: Расписание на заданный день
                недели для указанной группы?</h2>";

  echo '<body>
	<table>
		<tr>
			<th>number_group</th>
			<th>weekday</th>
			<th>number_classroom</th>
      <th>name_subject</th>
		</tr>';

	foreach ($result4 as $row) {
    echo '<tr>';
		echo '<td>' . $row['number_group'] . '</td>';
		echo '<td>' . $row['weekday'] . '</td>';
		echo '<td>' . $row['number_classroom'] . " " . '</td>';
    echo '<td>' . $row['name_subject'] . " " . '</td>';
    echo '</tr>';
	}
  echo '</table></body></html>';


// query 5

echo "<br/>" . "<h2>запрос 5: Сколько студентов обучается
                на каждом курсе в указанном классе?</h2>";

  echo '<body>
	<table>
		<tr>
			<th>number_course</th>
			<th>count</th>
		</tr>';

	foreach ($result5 as $row) {
    echo '<tr>';
		echo '<td>' . $row['number_course'] . '</td>';
		echo '<td>' . $row['count'] . " " . '</td>';
    echo '</tr>';
	}
  echo '</table></body></html>';
