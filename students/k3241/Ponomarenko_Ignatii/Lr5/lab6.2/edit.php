<?php
    require_once 'db.php';

    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = pg_query($link, $sql);
    $myrow = pg_fetch_array($result);

    if (isset($_GET['edit']))
    {
        $id = $_GET['id'];
        $name = $_GET['name'];  
        $surname = $_GET['surname'];
        $patronymic = $_GET['patronymic'];
        $email = $_GET['email'];
        $phone_number = $_GET['phone_number'];
        $date_of_burn = $_GET['date_of_burn'];

        $sql2 = "UPDATE users SET id='$id', name='$name', surname='$surname', patronymic='$patronymic', email='$email', phone_number='$phone_number', date_of_burn='$date_of_burn' WHERE id='$id'";
        $result2 = pg_query($link, $sql2) or die ("Ошибка " . pg_error($link));

    header("Location: index.php");

    }
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
    <div class="conteiner">
        <h1>Редактирование личных данных о пользователе</h1>

        <div class="forma">
            <form action="" method="get">
            <input type="hidden" name="id" value="<?=$_GET['id']?>">
            <label for="">
                    ИМЯ
                    <input type="text" name="name" value="<?=$myrow['name']?>" class="form-item" required>
                </label>
                <label for="">
                    ФАМИЛИЯ
                    <input type="text" name="surname" value="<?=$myrow['surname']?>" class="form-item" required>
                </label>
                <label for="">
                    ОТЧЕСТВО
                    <input type="text" name="patronymic" value="<?=$myrow['patronymic']?>" class="form-item" required>
                </label>
                <label for="">
                    ПОЧТА
                    <input type="email" name="email" value="<?=$myrow['email']?>" class="form-item" required>
                </label>
                <label for="">
                    НОМЕР ТЕЛЕФОНА
                    <input type="text" name="phone_number" value="<?=$myrow['phone_number']?>" class="form-item" required>
                </label>
                <label for="">
                    ДАТА РОЖДЕНИЯ
                    <input type="date" name="date_of_burn" value="<?=$myrow['date_of_burn']?>" class="form-item" required>
                </label>
                <input type="submit" value="СОХРАНИТЬ" class="button" name="edit">
            </form>
        </div>
    </div>
</body>
</html>