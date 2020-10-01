<?php
session_start();
echo "Время начала сессии: ";
echo date('Y/m/d H:i:s', $_SESSION['time']);
?>
