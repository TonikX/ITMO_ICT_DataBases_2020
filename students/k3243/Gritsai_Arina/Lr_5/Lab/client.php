<?php

   $table = 'public.client';
   $db = pg_connect('host=localhost port=5433 dbname=lr_3 user=postgres password=343');
    
   $query = "select * from $table order by passport_id";
   $result = pg_fetch_all(pg_query($db, $query));
   $status = "";

   if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (isset($_POST["Delete"])) {
            $query = "delete from $table where \"passport_id\"='$_POST[passport_id]'";
            $status = "Deleted";
        }

        if (isset($_POST["Add"])) {
            $query = "insert into $table (passport_id, name, surname, patronymic, city) values ('$_POST[passport_id]', '$_POST[name]', '$_POST[surname]', '$_POST[patronymic]', '$_POST[city]')";
            echo $query;
            $status = "Added";
        }

        if (isset($_POST["Update"])) {

            $query = "Update $table set \"name\"='$_POST[name]', \"surname\"='$_POST[surname]', \"patronymic\"='$_POST[patronymic]', \"city\"='$_POST[city]' where \"passport_id\"='$_POST[passport_id]'";
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
    <input name="passport_id" placeholder="123456"> - passport_id - passport number of client
    <button type="submit" name="Delete">Удалить</button>
</form>
<form action="" method="post">
    <input name="passport_id" size="40" placeholder="123456"> - passport_id - passport number of client <Br>
    <input name="name" size="40" placeholder="Alena"> - name - name of client <Br>
    <input name="surname" size="40" placeholder="Selezneva"> - surname - surname of client <Br>
    <input name="patronymic" size="40" placeholder="Viktorovna"> - patronymic - patronymic of client <Br>
    <input name="city" size="40" placeholder="Saint-Petersburg"> - city - city client came from <Br>

    <button type="submit" name="Add">Добавить</button>
    <button type="submit" name="Update">Редактировать</button>

</form>
<?php echo $status ?>
</body>
</html>
