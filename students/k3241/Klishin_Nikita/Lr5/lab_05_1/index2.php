<?php
define("tr", "<br />");
session_start();
echo $_SESSION['result'];

function sum($a, $b)
{
    $c = $a + $b;
    echo 'a + b = ' . $c . tr;
}

function difference($a, $b)
{
    $c = $a - $b;
    echo 'a - b = ' . $c . tr;
}

function multiplication($a, $b)
{
    $c = $a * $b;
    echo 'a * b = ' . $c . tr;
}

function divide($a, $b)
{
    $c = $a / $b;
    echo 'a / b = ' . $c . tr;
}

if ($_POST['enter']) {
    switch ($_POST['operation']) {
        case 0:
            sum($_POST['a'], $_POST['b']);
            break;
        case 1:
            difference($_POST['a'], $_POST['b']);
            break;
        case 2:
            multiplication($_POST['a'], $_POST['b']);
            break;
        case 3:
            divide($_POST['a'], $_POST['b']);
            break;
    }
}
