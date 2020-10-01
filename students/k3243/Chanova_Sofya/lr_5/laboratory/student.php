<?php

	echo "<h1>table student<h1>";

  $link_address1 = 'index.php';
	echo "<a href='$link_address1'>to main</a>" . "<br/>";

	$host = "localhost";
	$dbname = "college";
	$dbuser = "postgres";
	$dbpass = "postgres";
	$db = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);


	// display table

	echo "
	<h2>table student</h2>";

	$result = $db->query("SELECT * FROM college.student
                        ORDER BY id_student");

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
			<th>full_name_student</th>
			<th>id_student</th>
			<th>number_group</th>
			<th>education_form</th>
		</tr>';

	foreach ($result as $row) {
    echo '<tr>';
		echo '<td>' . $row['full_name_student'] . '</td>';
		echo '<td>' . $row['id_student'] . " " . '</td>';
		echo '<td>' . $row['number_group'] . " " . '</td>';
		echo '<td>' . $row['education_form'] . "<br>" . '</td>';
    echo '</tr>';
	}
  echo '</table></body></html>';

// insert new row into table

echo '<head>
	<title>table student</title>
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

echo '<h2>enter information regarding a student</h2>
	<ul>
		<form name="insert" action="student.php" method="POST">
			<li>full_name_student:</li>
			<input type="text" name="full_name_student" />
			<li>id_student:</li>
			<input type="text" name="id_student" />
			<li>number_group:</li>
			<input type="text" name="number_group" />
			<li>education_form:</li>
			<input type="text" name="education_form" />
			<input type="submit" name="submit_insert" /> </form>
	</ul>';

if (isset($_POST['submit_insert']))
{
  $db->beginTransaction();
  $insert_query = "INSERT INTO college.student VALUES
                   ('$_POST[full_name_student]',
                    '$_POST[id_student]',
                    '$_POST[number_group]',
                    '$_POST[education_form]')";

  $insert_result = $db->exec($insert_query);
  $db->commit();
  header("Location: student.php");
}

// redact information

echo '<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style>
	li {
		list-style: none;
	}
	</style>
</head>

<body>
	<h2>enter id_student to redact</h2>
	<ul>
		<form name="display" action="student.php" method="POST">
			<li>id_student:</li>
			<li>
				<input type="text" name="id_student_update" />
			</li>
			<li>
				<input type="submit" name="submit_update" />
			</li>
		</form>
	</ul>
</body>';

	if (isset($_POST['submit_update']))
	{
    $redact_query = "SELECT * FROM college.student
  	                 WHERE id_student = '$_POST[id_student_update]'";
  	$redact_result = $db->query($redact_query);
    $row = $redact_result->fetch();

	echo "<ul>
	<form name='update' action='student.php' method='POST'>
		<li>full_name_student:</li>
		<li>
			<input type='text' name='full_name_student_updated' value='$row[full_name_student]' />
		</li>
		<li>id_student:</li>
		<li>
			<input type='text' name='id_student_updated' value='$row[id_student]' />
		</li>
		<li>number_group:</li>
		<li>
			<input type='text' name='number_group_updated' value='$row[number_group]' />
		</li>
		<li>education_form:</li>
		<li>
			<input type='text' name='education_form_updated' value='$row[education_form]' />
		</li>
		<li>
			<input type='submit' name='new' />
		</li>
	</form>
</ul>";
	}

	if (isset($_POST['new']))

	{
  $db->beginTransaction();
	$new_query = "UPDATE college.student
		            SET full_name_student = '$_POST[full_name_student_updated]',
		                number_group = '$_POST[number_group_updated]',
		                education_form = '$_POST[education_form_updated]'
		            WHERE id_student = '$_POST[id_student_updated]'";
	$new_result = $db->exec($new_query);
  $db->commit();
	if (!$new_result)
	{
	echo "something went wrong :()";
	} else
	{
	header("Location: student.php");
	}
	}

  // delete information


echo '<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style>
	li {
		list-style: none;
	}
	</style>
</head>

<body>
	<h2>enter id_student to delete</h2>
	<ul>
		<form name="display" action="student.php" method="POST">
			<li>id_student:</li>
			<li>
				<input type="text" name="id_student_delete" />
			</li>
			<li>
				<input type="submit" name="submit_delete" />
			</li>
		</form>
	</ul>
</body>';

	if (isset($_POST['submit_delete']))
	{
  $db->beginTransaction();
	$delete_query = "DELETE FROM college.student
									 WHERE id_student = '$_POST[id_student_delete]'";
	$detete_result = $db->exec($delete_query);
  $db->commit();
	if (!$detete_result)
	{
	echo "something went wrong :()";
	} else
	{
	header("Location: student.php");
	}
	}
	echo '</html>';
