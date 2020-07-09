<?php

   $table = '"public"."room"';
   $db = pg_connect("host=localhost port=5433 dbname=lr_3 user=postgres password=343");
    
   $query = "select * from $table order by serial_number";
   $result = pg_fetch_all(pg_query($db, $query));
   $status = "";

   if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (isset($_POST["Delete"])) {
            $query = "delete from $table where \"serial_number\"='$_POST[serial_number]'";
            $status = "Deleted";
        }

        if (isset($_POST["Add"])) {
            $query = "insert into $table values ('$_POST[serial_number]', '$_POST[fki_floor_id]', '$_POST[cost_per_day]', '$_POST[telephone_num]', '$_POST[type]')";
            echo $query;
            $status = "Added";
        }

        if (isset($_POST["Update"])) {

            $query = "Update $table set \"fki_floor_id\"='$_POST[fki_floor_id]', \"cost_per_day\"='$_POST[cost_per_day]', \"telephone_num\"='$_POST[telephone_num]', \"type\"='$_POST[type]' where \"serial_number\"='$_POST[serial_number]'";
            $status = "Updated";
        }
        pg_query($query);
        echo "<meta http-equiv='refresh' content='0'>";
    }

    pg_close($db);
?>

<table>
  <thead>
<style type="text/css">

    body{
        margin-left: 20%;
        margin-right: 20%;
    }
</style>
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
    <input name="serial_number" placeholder="10"> - serial_number - room number
    <button type="submit" name="Delete">Удалить</button>
</form>
<form action="" method="post">
    <input name="serial_number" size="40" placeholder="10"> - serial_number - room number <Br>
    <input name="fki_floor_id" size="40" placeholder="1"> - fki_floor_id - floor number <Br>
    <input name="cost_per_day" size="40" placeholder="1500"> - cost_per_day - cost for one day to stay <Br>
    <input name="telephone_num" size="40" placeholder="6121111"> - telephone_num - number of telephone in room <Br>
    <input name="type" size="40" placeholder="single/double/triple"> - type - type of room <Br>

    <button type="submit" name="Add">Добавить</button>
    <button type="submit" name="Update">Редактировать</button>

</form>
<?php echo $status ?>
</body>
</html>
