<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    
    <title>Получается 5 лаба</title>
</head>

<body>
    <div class="container" style="display: flex; flex-direction: column; margin-top: 20px; align-items: center;">
    <?php
    $dbuser = "postgres";
    $dbpass = "123";
    $host = "localhost";
    $dbname= "Library";
    $table = 'public."Hall"';
    $db = pg_connect("host=$host dbname=$dbname user=$dbuser
    password=$dbpass");
    $query = "select * from $table order by \"id\" asc";
    $result = pg_fetch_all(pg_query($db, $query));
    $status = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (isset($_POST["Delete"])) {
            $query = "delete from $table where \"id\"='$_POST[id]'";
            $status = "Deleted";
        }

        if (isset($_POST["Add"])) {
            $id = end($result)["id"] + 1;
            $query = "insert into $table values ($id, '$_POST[capacity]', '$_POST[name]')";
            echo $query;
            $status = "Added";
        }

        if (isset($_POST["Update"])) {
            $query = "update $table set \"name\"='$_POST[name]', \"capacity\"='$_POST[capacity]' where \"id\"='$_POST[id]'";
            $status = "Updated";
        }
        pg_query($query);
        echo "<meta http-equiv='refresh' content='0'>";
    }
    
    pg_close($db);
    ?>

<h2>Удалить Запись</h2>
<form action="" method="post">
    <input name="id" placeholder="id">
    <button type="submit" name="Delete">Delete</button>
</form>

<h2>Обновить/добавить Запись</h2>
<form action="" method="post">
    <div class="container" style="display: flex; flex-direction: column;">
        <input name="id" size="40" placeholder="id(для изменения существующей)"> 
        <label for="capacity">Вместительность</label>
        <input name="capacity" size="40" placeholder="Вместительность">
        <label for="name">Название зала</label>
        <input name="name" size="40" placeholder="Название зала">
    </div>
    <div class="container" style="margin-top: 5px">
        <button type="submit" name="Update">Update</button>
        <button type="submit" name="Add">Add</button>
    </div>
</form>
    
    <h2 style="margin-top: 30px;">Таблица</h2>
    <table >
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
<?php echo $status ?>

</div>
</body>

</html>
