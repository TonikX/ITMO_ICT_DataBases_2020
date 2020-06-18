<?php
session_start();
echo "Время сессии, полученное с другой страницы: ";
echo date('Y m d H:i:s', $_SESSION['Время']);
?>