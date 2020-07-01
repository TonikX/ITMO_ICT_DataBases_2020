<?php
	
	$dbuser = "postgres";
	$dbpass = "root";
	$host = "localhost";
	$dbname= "Lab03";
	$table = 'enroll."School"';
	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
	password=$dbpass");
	$query = 'select * from enroll."School"' ;
	$result = pg_fetch_all(pg_query($db, $query));
	$status = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (isset($_POST["Delete"])) {
            $query = "delete from $table where \"SchooName\"='$_POST[SchooName]'";
            $status = "Deleted";
        }

        if (isset($_POST["Add"])) {
            $query = "insert into $table values ('$_POST[SchooName]', '$_POST[GraduationDate]', '$_POST[City]')";
            $status = "Added";
        }

        if (isset($_POST["UpGraduationDate"])) {
            $query = "update $table set \"GraduationDate\"='$_POST[GraduationDate]', \"City\"='$_POST[City]'where \"SchooName\"='$_POST[SchooName]'";
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
    <input name="SchooName" placeholder="228"> - school name
    <button type="submit" name="Delete">Delete</button>
</form>
<form action="" method="post">
    <input name="SchooName" size="40" placeholder=""> - school name
    <input name="GraduationDate" size="40" placeholder="07.06.2020"> - graduation date
    <input name="City" size="40" placeholder="Saint-Petersburg"> - issued by
    <button type="submit" name="Add">Add</button>
	<button type="submit" name="UpGraduationDate">Update</button>
</form>
<?php echo $status ?>
</body>
</html>