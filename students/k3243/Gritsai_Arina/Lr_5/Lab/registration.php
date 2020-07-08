<?php

   $table = '"public"."registration"';
   $db = pg_connect("host=localhost port=5433 dbname=lr_3 user=postgres password=343");
    
   $query = "select * from $table order by reg_id";
   $result = pg_fetch_all(pg_query($db, $query));
   $status = "";

   if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (isset($_POST["Delete"])) {
            $query = "delete from $table where \"reg_id\"='$_POST[reg_id]'";
            $status = "Deleted";
        }

        if (isset($_POST["Add"])) {
            $query = "insert into $table values ('$_POST[reg_id]', '$_POST[set_date]', '$_POST[off_date]', '$_POST[fki_serial_num]', '$_POST[fki_pass_id]', '$_POST[amount_of_days]', '$_POST[fki_floor_id]')";
            echo $query;
            $status = "Added";
        }

        if (isset($_POST["Update"])) {

            $query = "Update $table set \"set_date\"='$_POST[set_date]', \"off_date\"='$_POST[off_date]', \"fki_serial_num\"='$_POST[fki_serial_num]', \"fki_pass_id\"='$_POST[fki_pass_id]', \"amount_of_days\"='$_POST[amount_of_days]', \"fki_floor_id\"='$_POST[fki_floor_id]' where \"reg_id\"='$_POST[reg_id]'";
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
    <input name="reg_id" placeholder="1"> - reg_id - id of registration
    <button type="submit" name="Delete">Удалить</button>
</form>
<form action="" method="post">
    <input name="reg_id" size="40" placeholder="1"> - reg_id - id of registration <Br>
    <input name="set_date" size="40" placeholder="2020-01-01"> - set_date - date of arrival <Br>
    <input name="off_date" size="40" placeholder="2020-01-02"> - off_date - day of departure <Br>
    <input name="fki_serial_num" size="40" placeholder="10"> - fki_serial_num - room number <Br>
    <input name="fki_pass_id" size="40" placeholder="123456"> - fki_pass_id - passport number of client <Br>
    <input name="amount_of_days" size="40" placeholder="3"> - amount_of_days - number of days of stay <Br>
    <input name="fki_floor_id" size="40" placeholder="1"> - fki_floor_id - number of floor <Br>

    <button type="submit" name="Add">Добавить</button>
    <button type="submit" name="Update">Редактировать</button>

</form>
<?php echo $status ?>
</body>
</html>
