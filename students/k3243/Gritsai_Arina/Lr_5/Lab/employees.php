<?php

   $table = '"public"."employees"';
   $db = pg_connect("host=localhost port=5433 dbname=lr_3 user=postgres password=343");
    
   $query = "select * from $table order by personnel_num";
   $result = pg_fetch_all(pg_query($db, $query));
   $status = "";

   if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (isset($_POST["Delete"])) {
            $query = "delete from $table where \"personnel_num\"='$_POST[personnel_num]'";
            $status = "Deleted";
        }

        if (isset($_POST["Add"])) {
            $query = "insert into $table values ('$_POST[personnel_num]', '$_POST[wage]', '$_POST[surname_emp]','$_POST[name_emp]', '$_POST[patronymic_emp]')";
            echo $query;
            $status = "Added";
        }

        if (isset($_POST["Update"])) {

            $query = "Update $table set \"wage\"='$_POST[wage]', \"surname_emp\"='$_POST[surname_emp]', \"name_emp\"='$_POST[name_emp]', \"patronymic_emp\"='$_POST[patronymic_emp]' where \"personnel_num\"='$_POST[personnel_num]'";
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
    <input name="personnel_num" placeholder="1234"> - personnel_num - personnel number of employee
    <button type="submit" name="Delete">Удалить</button>
</form>
<form action="" method="post">
    <input name="personnel_num" size="40" placeholder="1234"> - personnel_num - personnel number of employee <Br>
    <input name="wage" size="40" placeholder="13000"> - wage - salary of employee <Br>
    <input name="surname_emp" size="40" placeholder="Selezneva"> - surname_emp - surname of employee <Br>
    <input name="name_emp" size="40" placeholder="Alena"> - name_emp - name of employee <Br>
    <input name="patronymic_emp" size="40" placeholder="Viktorovna"> - patronymic - patronymic of employee <Br>

    <button type="submit" name="Add">Добавить</button>
    <button type="submit" name="Update">Редактировать</button>

</form>
<?php echo $status ?>
</body>
</html>
