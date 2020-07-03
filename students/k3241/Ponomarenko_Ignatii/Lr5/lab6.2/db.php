<?php

    $link = pg_connect("host=localhost port=5432 dbname=users user=postgres password=admin");
    if ($link == false)
    {
        print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
    }
    var_dump($link);

?>