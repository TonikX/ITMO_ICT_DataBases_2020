<?php

	echo "<h1>table schedule<h1>";

  $link_address1 = 'index.php';
  echo "<a href='$link_address1'>to main</a>" . "<br/>";

	$host = "localhost";
	$dbname = "college";
	$dbuser = "postgres";
	$dbpass = "postgres";
	$db = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);


	// display table

	echo "
	<h2>table schedule</h2>";

	$result = $db->query("SELECT * FROM college.schedule
										    ORDER BY date");

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
			<th>date</th>
			<th>weekday</th>
			<th>number_classroom</th>
			<th>id_teacher</th>
      <th>number_group</th>
      <th>id_subject</th>
		</tr>';

	foreach ($result as $row) {
    echo '<tr>';
		echo '<td>' . $row['date'] . '</td>';
		echo '<td>' . $row['weekday'] . " " . '</td>';
		echo '<td>' . $row['number_classroom'] . " " . '</td>';
		echo '<td>' . $row['id_teacher'] . "<br>" . '</td>';
    echo '<td>' . $row['number_group'] . "<br>" . '</td>';
    echo '<td>' . $row['id_subject'] . "<br>" . '</td>';
    echo '</tr>';
	}
  echo '</table></body></html>';

// insert new row into table

echo '<head>
	<title>table schedule</title>
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
<h2>enter information regarding schedule for a day</h2>
<ul>
<form name="insert" action="schedule.php" method="POST" >
<li>date:</li>
<input type="text" name="date"/>
<li>weekday:</li>
<input type="text" name="weekday"/>
<li>number_classroom:</li>
<input type="text" name="number_classroom"/>
<li>id_teacher:</li>
<input type="text" name="id_teacher"/>
<li>number_group:</li>
<input type="text" name="number_group"/>
<li>id_subject:</li>
<input type="text" name="id_subject"/>
<input type="submit"  name="submit_insert"/>
</form>
</ul>
</body>';

if (isset($_POST['submit_insert']))
{
  $db->beginTransaction();
  $insert_query = "INSERT INTO college.schedule VALUES
                 ('$_POST[date]',
                  '$_POST[weekday]',
                  '$_POST[number_classroom]',
                  '$_POST[id_teacher]',
                  '$_POST[number_group]',
                  '$_POST[id_subject]')";

  $insert_result = $db->exec($insert_query);
  $db->commit();
  header("Location: schedule.php");
}

// redact information

echo '<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<style>
	li {list-style: none;}
	</style>

	</head>
	<body>
	<h2>enter date to redact schedule</h2>

	<ul>
	<form name="display" action="schedule.php" method="POST" >
	<li>date:</li>
	<li><input type="text" name="date_update"/></li>
	<li><input type="submit" name="submit_update" /></li>
	</form>
	</ul>
	</body>
	</html>';

	if (isset($_POST['submit_update']))
	{
    $redact_query = "SELECT * FROM college.schedule
  	                   WHERE date = '$_POST[date_update]'";
  	$redact_result = $db->query($redact_query);
    $row = $redact_result->fetch();

    echo "<ul>

  	<form name='update' action='schedule.php' method='POST'>
  	<li>date:</li>
  	<li><input type='text' name='date_updated' value='$row[date]'/></li>

  	<li>weekday:</li>
  	<li><input type='text' name='weekday_updated' value='$row[weekday]'/></li>

  	<li>number_classroom:</li>
  	<li><input type='text' name='number_classroom_updated' value='$row[number_classroom]'/></li>

  	<li>id_teacher:</li>
  	<li><input type='text' name='id_teacher_updated' value='$row[id_teacher]'/></li>

  	<li>number_group:</li>
  	<li><input type='text' name='number_group_updated' value='$row[number_group]'/></li>

  	<li>id_subject:</li>
  	<li><input type='text' name='id_subject_updated' value='$row[id_subject]'/></li>

  	<li><input type='submit' name='new'/></li>
  	</form>

  	</ul>";
	}

	if (isset($_POST['new']))

	{
  $db->beginTransaction();
  $new_query = "UPDATE college.schedule
		            SET weekday = '$_POST[weekday_updated]',
		                number_classroom = '$_POST[number_classroom_updated]',
										id_teacher = '$_POST[id_teacher_updated]',
										number_group = '$_POST[number_group_updated]',
										id_subject = '$_POST[id_subject_updated]'
		            WHERE date = '$_POST[date_updated]'";
	$new_result = $db->exec($new_query);
  $db->commit();
	if (!$new_result)
	{
	echo "something went wrong :()";
	} else
	{
	header("Location: schedule.php");
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
		<h2>enter date to delete schedule for a day</h2>

		<ul>
		<form name="display" action="schedule.php" method="POST" >
		<li>date:</li>
		<li><input type="text" name="date_delete"/></li>
		<li><input type="submit" name="submit_delete" /></li>
		</form>
		</ul>
		</body>';

	if (isset($_POST['submit_delete']))
	{
  $db->beginTransaction();
  $delete_query = "DELETE FROM college.schedule
									 WHERE date = '$_POST[date_delete]'";
	$detete_result = $db->exec($delete_query);
  $db->commit();
	if (!$detete_result)
	{
	echo "something went wrong :()";
	} else
	{
	header("Location: schedule.php");
	}
	}
	echo '</html>';
