<?php 
    require_once 'db.php';

    $sql = "SELECT * FROM users";
    $result = pg_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>
    <section>
        <div class="news">
            <table>
                <tr>
                    <th>ID</th>
                    <th>ИМЯ</th>
                    <th>ФАМИЛИЯ</th>
                    <th>ОТЧЕСТВО</th>
                    <th>ПОЧТА</th>
                    <th>ТЕЛЕФОН</th>
                    <th>ДАТА РОЖДЕНИЯ</th>
                </tr>
                <?php while($myrow = pg_fetch_array($result)): ?>
                <tr>
                    <th>
                        <?=$myrow['id'] ?>
                    </th>
                    <th>
                        <?=$myrow['name'] ?>
                    </th>
                    <th>
                        <?=$myrow['surname'] ?>
                    </th>
                    <th>
                        <?=$myrow['patronymic'] ?>
                    </th>
                    <th>
                        <?=$myrow['email'] ?>
                    </th>
                    <th>
                        <?=$myrow['phone_number'] ?>
                    </th>
                    <th>
                        <?=$myrow['date_of_burn'] ?>
                    </th>
                    <th>
                        <a href="edit.php?id=<?=$myrow['id']?>">РЕДАКТИРОВАТЬ</a>
                    </th>
                    <th>
                        <a href="delete.php?id=<?=$myrow['id']?>">УДАЛИТЬ</a>
                    </th>
                </tr>
                <?php endwhile ?>
            </table>
        </div>
    </section>

    <div class="new">
        <a href="add.php">Добавить пользователя</a>
    </div>
</body>
</html>