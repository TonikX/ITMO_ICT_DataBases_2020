<?php

   $table = '"public"."floor"';
   $db = pg_connect("host=localhost port=5433 dbname=lr_3 user=postgres password=343");
    
   $query = "select * from $table order by floor_id";
   $result = pg_fetch_all(pg_query($db, $query));
   $status = "";

   if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (isset($_POST["Delete"])) {
            $query = "delete from $table where \"floor_id\"='$_POST[floor_id]'";
            $status = "Deleted";
        }

        if (isset($_POST["Add"])) {
            $query = "insert into $table values ('$_POST[floor_id]', '$_POST[floor_num]')";
            echo $query;
            $status = "Added";
        }

        if (isset($_POST["Update"])) {

            $query = "Update $table set \"floor_num\"='$_POST[floor_num]' where \"floor_id\"='$_POST[floor_id]'";
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
    <input name="floor_id" placeholder="1"> - floor_id
    <button type="submit" name="Delete">Удалить</button>
</form>
<form action="" method="post">
    <input name="floor_id" size="40" placeholder="1"> - floor_id <Br>
    <input name="floor_num" size="40" placeholder="1"> - floor_num <Br>

    <button type="submit" name="Add">Добавить</button>
    <button type="submit" name="Update">Редактировать</button>

</form>
<?php echo $status ?>
</body>
</html>
