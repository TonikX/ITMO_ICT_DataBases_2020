<?php
    require_once 'db.php';

    if(isset($_GET['button']))
    {
        $id = $_GET['id'];
        $name = $_GET['name'];  
        $surname = $_GET['surname'];
        $patronymic = $_GET['patronymic'];
        $email = $_GET['email'];
        $phone_number = $_GET['phone_number'];
        $date_of_burn = $_GET['date_of_burn'];

        $sql = "INSERT INTO users VALUES ('$id', '$name', '$surname', '$patronymic', '$email', '$phone_number', '$date_of_burn')";
        $result = pg_query($link, $sql);
        if ($result == true)
        {
            echo "Информация занесена в базу данных";
        }
        else
        {
            echo "Информация не занесена в базу данных";
        }
        header("Location: index.php");

    }   
    var_dump($result);
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
        <h1>Добавление пользователя</h1>

        <div class="forma">
            <form action="" method="get">
                <label for="">
                    ID
                    <input type="nubmer" name="id" value="" class="form-item" autofocus required>
                </label>
                <label for="">
                    ИМЯ
                    <input type="text" name="name" value="" class="form-item" required>
                </label>
                <label for="">
                    ФАМИЛИЯ
                    <input type="text" name="surname" value="" class="form-item" required>
                </label>
                <label for="">
                    ОТЧЕСТВО
                    <input type="text" name="patronymic" value="" class="form-item" required>
                </label>
                <label for="">
                    ПОЧТА
                    <input type="email" name="email" value="" class="form-item" required>
                </label>
                <label for="">
                    НОМЕР ТЕЛЕФОНА
                    <input type="text" name="phone_number" value="" class="form-item" required>
                </label>
                <label for="">
                    ДАТА РОЖДЕНИЯ
                    <input type="date" name="date_of_burn" value="" class="form-item" required>
                </label>
                <input type="submit" value="СОХРАНИТЬ" name="button" class="button">
            </form>
        </div>
    </div>
</body>
</html>