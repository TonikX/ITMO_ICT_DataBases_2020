<?php
session_start();
echo 'юзернейм: ', $_SESSION['username'], '<br>', 'масть: ', $_SESSION['status'], '<br>';

echo '<HTML>
     <HEAD>
     <META HTTP-EQUIV="Refresh" CONTENT="3; URL=index.php">
     <TITLE>это тоже я</TITLE>
     </HEAD>
     <BODY>
     <img src="images/uh_oh.jpg" alt="ой">
     </BODY>
     </HTML>';
?>
