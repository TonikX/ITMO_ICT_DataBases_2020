<?php

	echo "<h1>table group<h1>";

  $link_address1 = 'index.php';
  echo "<a href='$link_address1'>to main</a>" . "<br/>";

	$host = "localhost";
	$dbname = "college";
	$dbuser = "postgres";
	$dbpass = "postgres";
	$db = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);


	// display table

	echo "
	<h2>table group</h2>";

	$result = $db->query("SELECT * FROM college.group
										    ORDER BY number_group");

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
			<th>number_group</th>
			<th>number_course</th>
			<th>name_course</th>
			<th>faculty</th>
		</tr>';

	foreach ($result as $row) {
    echo '<tr>';
		echo '<td>' . $row['number_group'] . '</td>';
		echo '<td>' . $row['number_course'] . " " . '</td>';
		echo '<td>' . $row['name_course'] . " " . '</td>';
		echo '<td>' . $row['faculty'] . "<br>" . '</td>';
    echo '</tr>';
	}
  echo '</table></body></html>';

// insert new row into table

echo '<head>
	<title>table group</title>
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

echo '<h2>enter information regarding a group</h2>
	<ul>
		<form name="insert" action="group.php" method="POST">
			<li>number_group:</li>
			<input type="text" name="number_group" />
			<li>number_course:</li>
			<input type="text" name="number_course" />
			<li>name_course:</li>
			<input type="text" name="name_course" />
			<li>faculty:</li>
			<input type="text" name="faculty" />
			<input type="submit" name="submit_insert" /> </form>
	</ul>';

if (isset($_POST['submit_insert']))
{
  $db->beginTransaction();
  $insert_query = "INSERT INTO college.group VALUES
                   ('$_POST[number_group]',
                    '$_POST[number_course]',
                    '$_POST[name_course]',
                    '$_POST[faculty]')";

  $insert_result = $db->exec($insert_query);
  $db->commit();
  header("Location: group.php");
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
	<h2>enter number_group to redact</h2>
	<ul>
		<form name="display" action="group.php" method="POST">
			<li>number_group:</li>
			<li>
				<input type="text" name="number_group_update" />
			</li>
			<li>
				<input type="submit" name="submit_update" />
			</li>
		</form>
	</ul>
</body>';

	if (isset($_POST['submit_update']))
	{
    $redact_query = "SELECT * FROM college.group
		                 WHERE number_group = '$_POST[number_group_update]'";
  	$redact_result = $db->query($redact_query);
    $row = $redact_result->fetch();

    echo "<ul>

    <form name='update' action='group.php' method='POST'>
    <li>number_group:</li>
    <li><input type='text' name='number_group_updated' value='$row[number_group]'/></li>

    <li>number_course:</li>
    <li><input type='text' name='number_course_updated' value='$row[number_course]'/></li>

    <li>name_course:</li>
    <li><input type='text' name='name_course_updated' value='$row[name_course]'/></li>

    <li>faculty:</li>
    <li><input type='text' name='faculty_updated' value='$row[faculty]'/></li>

    <li><input type='submit' name='new'/></li>
    </form>

    </ul>";
	}

	if (isset($_POST['new']))

	{
  $db->beginTransaction();
  $new_query = "UPDATE college.group
                SET number_course = '$_POST[number_course_updated]',
                    name_course = '$_POST[name_course_updated]',
                    faculty = '$_POST[faculty_updated]'
                WHERE number_group = '$_POST[number_group_updated]'";
	$new_result = $db->exec($new_query);
  $db->commit();
	if (!$new_result)
	{
	echo "something went wrong :()";
	} else
	{
	header("Location: group.php");
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
    <h2>enter number_group to delete</h2>

    <ul>
    <form name="display" action="group.php" method="POST" >
    <li>number_group:</li>
    <li><input type="text" name="number_group_delete"/></li>
    <li><input type="submit" name="submit_delete" /></li>
    </form>
    </ul>
    </body>';

	if (isset($_POST['submit_delete']))
	{
  $db->beginTransaction();
  $delete_query = "DELETE FROM college.group
                   WHERE number_group = '$_POST[number_group_delete]'";
	$detete_result = $db->exec($delete_query);
  $db->commit();
	if (!$detete_result)
	{
	echo "something went wrong :()";
	} else
	{
	header("Location: group.php");
	}
	}
	echo '</html>';
