<?php
session_start();
echo "Время сессии, полученное из part12.php: ";
echo date('Y m d H:i:s', $_SESSION['Время']);
echo "<br/>";
?> 
 <a href = 'index.php'>Главная страница</a> 