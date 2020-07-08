<?php

   $table = '"public"."cleaning_schedule"';
   $db = pg_connect("host=localhost port=5433 dbname=lr_3 user=postgres password=343");
    
   $query = "select * from $table order by cleaning_id";
   $result = pg_fetch_all(pg_query($db, $query));
   $status = "";

   if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (isset($_POST["Delete"])) {
            $query = "delete from $table where \"cleaning_id\"='$_POST[cleaning_id]'";
            $status = "Deleted";
        }

        if (isset($_POST["Add"])) {
            $query = "insert into $table values ('$_POST[cleaning_id]', '$_POST[data]', '$_POST[week_day]', '$_POST[fki_floot_id]', '$_POST[fki_pers_num]', '$_POST[fki_serial_num]')";
            echo $query;
            $status = "Added";
        }

        if (isset($_POST["Update"])) {

            $query = "Update $table set \"data\"='$_POST[data]', \"week_day\"='$_POST[week_day]', \"fki_floot_id\"='$_POST[fki_floot_id]', \"fki_pers_num\"='$_POST[fki_pers_num]', \"fki_serial_num\"='$_POST[fki_serial_num]' where \"cleaning_id\"='$_POST[cleaning_id]'";
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
    <input name="cleaning_id" placeholder="1"> - cleaning_id
    <button type="submit" name="Delete">Удалить</button>
</form>
<form action="" method="post">
    <input name="cleaning_id" size="40" placeholder="1"> - cleaning_id <Br>
    <input name="data" size="40" placeholder="2020-01-01"> - data - date of cleaning <Br>
    <input name="week_day" size="40" placeholder="Monday"> - week_day - day of week <Br>
    <input name="fki_floot_id" size="40" placeholder="1"> - fki_floor_id - floor number <Br>
    <input name="fki_pers_num" size="40" placeholder="1234"> - fki_pers_nem - personnel number of employee <Br>
    <input name="fki_serial_num" size="40" placeholder="10"> - fki_serial_num - number of room <Br>

    <button type="submit" name="Add">Добавить</button>
    <button type="submit" name="Update">Редактировать</button>

</form>
<?php echo $status ?>
</body>
</html>
