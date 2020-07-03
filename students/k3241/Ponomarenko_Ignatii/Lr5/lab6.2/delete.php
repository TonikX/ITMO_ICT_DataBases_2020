<?php
    require_once 'db.php';
    if(isset($_GET['id']))
    {   
        $id = $_GET['id'];
        
        $query ="DELETE FROM users WHERE id = '$id'";
    
        $result = pg_query($link, $query) or die("Ошибка " . pg_error($link)); 

        header("Location: index.php");
    }
?>