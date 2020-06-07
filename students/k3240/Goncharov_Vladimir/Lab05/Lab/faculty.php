<?php
	
	$dbuser = "postgres";
	$dbpass = "root";
	$host = "localhost";
	$dbname= "Lab03";
	$table = 'enroll."Faculty"';
	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
	password=$dbpass");
	$query = 'select * from enroll."Faculty"' ;
	$result = pg_fetch_all(pg_query($db, $query));
	$status = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (isset($_POST["Delete"])) {
            $query = "delete from $table where \"FacultyName\"='$_POST[FacultyName]'";
            $status = "Deleted";
        }

        if (isset($_POST["Add"])) {
            $query = "insert into $table values ('$_POST[Email]', '$_POST[FacultyName]')";
            $status = "Added";
        }

        if (isset($_POST["Update"])) {
            $query = "update $table set \"Email\"='$_POST[Email]' where \"FacultyName\"='$_POST[FacultyName]'";
            $status = "Updated";
        }
        pg_query($query);
        echo "<meta http-equiv='refresh' content='0'>";
    }

    pg_close($db);
?>

<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($result[0])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($result as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>

<body>
<form action="" method="post">
    <label><input name="FacultyName" placeholder="228"> Faculty Name</label>
    <button type="submit" name="Delete">Delete</button>
</form>
<form action="" method="post">
    <input name="FacultyName" size="40" placeholder="Slytherin">
    <input name="Email" size="40" placeholder="slytherin@hogwarts.edu">
    <button type="submit" name="Add">Add</button>
	<button type="submit" name="Update">Update</button>
</form>
<?php echo $status ?>
</body>
</html>