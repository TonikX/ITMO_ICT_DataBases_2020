<?php
	
	$dbuser = "postgres";
	$dbpass = "root";
	$host = "localhost";
	$dbname= "Lab03";
	$table = 'enroll."Enrollee"';
	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
	password=$dbpass");
	$query = "select * from $table order by \"ID\" asc";
	$result = pg_fetch_all(pg_query($db, $query));
	$status = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (isset($_POST["Delete"])) {
            $query = "delete from $table where \"ID\"='$_POST[ID]'";
            $status = "Deleted";
        }

        if (isset($_POST["Add"])) {
            $id = end($result)["ID"] + 1;
            $gm = isset($_POST["GoldenMedal"])? 'true' : 'false';
            $sm = isset($_POST["SilverMedal"])? 'true' : 'false';
            $p =  isset($_POST["Preferential"])? 'true' : 'false';
            $query = "insert into $table values ($id, '$_POST[Name]', '$_POST[Foundation]', $gm, $sm, '$_POST[PassportNumber]', NULL, NULL, $p, '$_POST[School]')";
            echo $query;
            $status = "Added";
        }

        if (isset($_POST["Update"])) {
            $gm = isset($_POST["GoldenMedal"])? 'true' : 'false';
            $sm = isset($_POST["SilverMedal"])? 'true' : 'false';
            $p =  isset($_POST["Preferential"])? 'true' : 'false';
            $query = "update $table set \"Name\"='$_POST[Name]', \"Foundation\"='$_POST[Foundation]', \"GoldenMedal\"=$gm, \"SilverMedal\"=$sm, \"PassportNumber\"='$_POST[PassportNumber]', \"Preferential\"=$p, \"School\"='$_POST[School]' where \"ID\"='$_POST[ID]'";
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
    <input name="ID" placeholder="228"> - id
    <button type="submit" name="Delete">Delete</button>
</form>
<form action="" method="post">
    <input name="ID" size="40" placeholder="228"> - id <Br>
    <input name="Name" size="40" placeholder="Anonim Anon Anon"> - name <Br>
    <input name="Foundation" size="40" placeholder="Budget"> - foundation <Br>
    <input type="checkbox" name="GoldenMedal"> - golden medal <Br>
    <input type="checkbox" name="SilverMedal"> - silver medal <Br>
    <input name="PassportNumber" size="40" placeholder="1488322228"> - passport number <Br>
    <input type="checkbox" name="Preferential"> - preferential <Br>
    <input name="School" size="40" placeholder="№50"> - school name <Br>
    <button type="submit" name="Add">Add</button>
	<button type="submit" name="Update">Update</button>
</form>
<?php echo $status ?>
</body>
</html>