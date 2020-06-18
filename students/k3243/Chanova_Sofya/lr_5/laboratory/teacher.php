<?php

	echo "<h1>table teacher<h1>";

  $link_address1 = 'index.php';
  echo "<a href='$link_address1'>to main</a>" . "<br/>";

	$host = "localhost";
	$dbname = "college";
	$dbuser = "postgres";
	$dbpass = "postgres";
	$db = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);


	// display table

	echo "
	<h2>table teacher</h2>";

	$result = $db->query("SELECT * FROM college.teacher
										    ORDER BY id_teacher");

  echo '<html>';
  echo '<body><table><tr>';
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

  tr:nth-child(even){background-color: #f2f2f2}

  tr:hover {background-color: #ddd;}

  </style>
  </head>';

  echo '<body>
	<table>
		<tr>
			<th>id_teacher</th>
			<th>full_name_teacher</th>
			<th>experience_teacher</th>
			<th>qualifications</th>
		</tr>';

	foreach ($result as $row) {
    echo '<tr>';
		echo '<td>' . $row['id_teacher'] . '</td>';
		echo '<td>' . $row['full_name_teacher'] . " " . '</td>';
		echo '<td>' . $row['experience_teacher'] . " " . '</td>';
		echo '<td>' . $row['qualifications'] . "<br>" . '</td>';
    echo '</tr>';
	}
  echo '</table></body></html>';

// insert new row into table

echo '<head>
	<title>table teacher</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style>
	li {
		listt-style: none;
	}

	input[type=submit] {
		background-color: #615987;
		border: none;
		color: white;
		padding: 8px 16px;
		cursor: pointer;
	}
	</style>
</head>';

echo '<body>
<h2>enter information regarding a teacher</h2>
<ul>
<form name="insert" action="teacher.php" method="POST" >
<li>id_teacher:</li>
<input type="text" name="id_teacher"/>
<li>full_name_teacher:</li>
<input type="text" name="full_name_teacher"/>
<li>experience_teacher:</li>
<input type="text" name="experience_teacher"/>
<li>qualifications:</li>
<input type="text" name="qualifications"/>
<input type="submit" name="submit_insert"/>
</form>
</ul>
</body>';

if (isset($_POST['submit_insert']))
{
  $db->beginTransaction();
  $insert_query = "INSERT INTO college.teacher VALUES
	                 ('$_POST[id_teacher]',
	                  '$_POST[full_name_teacher]',
	                  '$_POST[experience_teacher]',
	                  '$_POST[qualifications]')";

  $insert_result = $db->exec($insert_query);
  $db->commit();
  header("Location: teacher.php");
}

// redact information

echo '<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<style>
	li {list-style: none;}
	</style>

	</head>
	<body>
	<h2>enter id_teacher to redact</h2>

	<ul>
	<form name="display" action="teacher.php" method="POST" >
	<li>id_teacher:</li>
	<li><input type="text" name="id_teacher_update"/></li>
	<li><input type="submit" name="submit_update" /></li>
	</form>
	</ul>
	</body>
	</html>';

	if (isset($_POST['submit_update']))
	{
    $redact_query = "SELECT * FROM college.teacher
  	                 WHERE id_teacher = '$_POST[id_teacher_update]'";
  	$redact_result = $db->query($redact_query);
    $row = $redact_result->fetch();

    echo "<ul>

  	<form name='update' action='teacher.php' method='POST'>
  	<li>id_teacher:</li>
  	<li><input type='text' name='id_teacher_updated' value='$row[id_teacher]'/></li>

  	<li>full_name_teacher:</li>
  	<li><input type='text' name='full_name_teacher_updated' value='$row[full_name_teacher]'/></li>

  	<li>experience_teacher:</li>
  	<li><input type='text' name='experience_teacher_updated' value='$row[experience_teacher]'/></li>

  	<li>qualifications:</li>
  	<li><input type='text' name='qualifications_updated' value='$row[qualifications]'/></li>

  	<li><input type='submit' name='new'/></li>
  	</form>

  	</ul>";
	}

	if (isset($_POST['new']))

	{
  $db->beginTransaction();
  $new_query = "UPDATE college.teacher
		            SET full_name_teacher = '$_POST[full_name_teacher_updated]',
		                experience_teacher = '$_POST[experience_teacher_updated]',
		                qualifications = '$_POST[qualifications_updated]'
		            WHERE id_teacher = '$_POST[id_teacher_updated]'";
	$new_result = $db->exec($new_query);
  $db->commit();
	if (!$new_result)
	{
	echo "something went wrong :()";
	} else
	{
	header("Location: teacher.php");
	}
	}

  // delete information

  echo '<head>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<style>
		li {list-style: none;}
		</style>

		</head>
		<body>
		<h2>enter id_teacher to delete</h2>

		<ul>
		<form name="display" action="teacher.php" method="POST" >
		<li>id_teacher:</li>
		<li><input type="text" name="id_teacher_delete"/></li>
		<li><input type="submit" name="submit_delete" /></li>
		</form>
		</ul>
		</body>';

	if (isset($_POST['submit_delete']))
	{
  $db->beginTransaction();
  $delete_query = "DELETE FROM college.teacher
									 WHERE id_teacher = '$_POST[id_teacher_delete]'";
	$detete_result = $db->exec($delete_query);
  $db->commit();
	if (!$detete_result)
	{
	echo "something went wrong :()";
	} else
	{
	header("Location: teacher.php");
	}
	}
	echo '</html>';
