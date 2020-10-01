<?php
    session_start();
    echo "У вас не получилось закрыть сессию, ведь ты сделал не все лабы по БД \r\n";
?>
    <br>
    <?php
    echo "\r\n Но php сессия закрылась \r\n";
    $_SESSION = array();
    session_destroy();
    ?>
<a href="session.php">Проверить сессию</a>