<?php
  try {
    $dbh = new PDO('pgsql:host=localhost;port=5433;dbname=lr_3;user=postgres;password=343');
    echo "PDO connection object created";
  }
  catch(PDOException $e) {
    echo $e->getMessage();
  }
?>
<p><a href="cleaning_schedule.php">Расписание уборки</a></p>
<p><a href="client.php">Клиенты</a></p>
<p><a href="employees.php">Работники</a></p>
<p><a href="floor.php">Этаж</a></p>
<p><a href="registration.php">Регистрация</a></p>
<p><a href="room.php">Номера</a></p>
<p><a href="sql.php">Пять запросов</a></p>
