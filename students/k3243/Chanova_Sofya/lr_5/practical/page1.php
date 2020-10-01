<?php

echo "<h1>my first php script</h1>";
echo "<h2>the second page </h2>";

// переменные со страницы main перенесены на эту с помощью сессии

session_start();

echo "<br/>" . "username: " . $_SESSION['username'] . "<br/>";
echo "role: " . $_SESSION['role'] . "<br/>";

session_destroy();
