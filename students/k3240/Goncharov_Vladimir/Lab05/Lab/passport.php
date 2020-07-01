<?php
	
	$dbuser = "postgres";
	$dbpass = "root";
	$host = "localhost";
	$dbname= "Lab03";
	$table = 'enroll."Passport"';
	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
	password=$dbpass");
	$query = 'select * from enroll."Passport"' ;
	$result = pg_fetch_all(pg_query($db, $query));
	$status = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (isset($_POST["Delete"])) {
            $query = "delete from $table where \"Number\"='$_POST[Number]'";
            $status = "Deleted";
        }

        if (isset($_POST["Add"])) {
            $query = "insert into $table values ('$_POST[Number]', '$_POST[Date]', '$_POST[IssuedBy]')";
            $status = "Added";
        }

        if (isset($_POST["Update"])) {
            $query = "update $table set \"Date\"='$_POST[Date]', \"IssuedBy\"='$_POST[IssuedBy]'where \"Number\"='$_POST[Number]'";
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
    <input name="Number" placeholder="228"> - passport number
    <button type="submit" name="Delete">Delete</button>
</form>
<form action="" method="post">
    <input name="Number" size="40" placeholder=""> - passport number
    <input name="Date" size="40" placeholder="07.06.2020"> - issue date
    <input name="IssuedBy" size="40" placeholder="OUFMS..."> - issued by
    <button type="submit" name="Add">Add</button>
	<button type="submit" name="Update">Update</button>
</form>
<?php echo $status ?>
</body>
</html>