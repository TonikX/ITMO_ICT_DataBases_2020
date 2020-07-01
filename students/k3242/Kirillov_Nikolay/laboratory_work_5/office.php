<?php

 	$dbuser = 'postgres';
    $dbpass = 'Bargi20012';
    $host = 'localhost';
    $dbname = 'headteacher';
    $table = '"school"."office"';
    $db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
 	$query = "SELECT * FROM $table";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "DELETE FROM $table WHERE \"id_office\"='$_POST[id_office]'";
             $status = "Deleted";
         }
 
         if (isset($_POST["Add"])) {
             $query = "INSERT INTO $table (number_office, floor_number) VALUES ('$_POST[number_office]', '$_POST[floor_number]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "UPDATE $table SET \"number_office\"='$_POST[number_office]', \"floor_number\"='$_POST[floor_number]' WHERE \"id_office\"='$_POST[id_office]'";
             $status = "Updated";
         }
         pg_query($query);
         echo "<meta http-equiv='refresh' content='0'>";
     }

     pg_close($db);
 ?>
 <body vlink = "black">
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbar1">
        <a class="navbar-brand" href="index.php">Главная</a>       
    </div>
 </nav>

 <table>
   <thead>
     <tr>
       <th><?php echo implode('</th><th>', array_keys($result[0])); ?></th>
     </tr>
   </thead>
   <tbody>
 <?php foreach ($result as $row): array_map('htmlentities', $row); ?>
     <tr>
       <td><?php echo implode('</td><td>', $row); ?></td>
     </tr>
 <?php endforeach; ?>
   </tbody>
 </table>

 <form action="" method="post">
     <label><input name="id_office" placeholder="1"> - id_office (id кабинета) </label>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
	 <input name="floor_number" size="40" placeholder="3"> - floor_number (номер этажа) <Br>
	 <input name="number_office" size="40" placeholder="25"> - number_office (номер кабинета) <Br>
	 <input name="id_office" size="40" placeholder="1"> - id_office (id кабинета) <Br>
     <button type="submit" name="Add">Добавить</button>
 	 <button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 <style>
    body{
        background: #333;
        background-size: cover;
    }
    table, td, th, caption{
        font-family: Calibri;
        width: 70%;
        height: 10%;
        margin: auto;
        border: 1px solid black;
        border-collapse:collapse;
        text-align:center;
        font-size: 15px;
        table-layout: fixed;
        background: white;
        opacity: 0.8;
        color: black;
        margin-top: 100px;
        
    }
    th, td {
        padding: 5px;
        opacity: 0.99;

    }
    a {
        text-decoration: none;
    }
    a:hover { 
        text-decoration: underline;
        color: grey;
    }
    form {
        font-family: Calibri; 
        margin: auto; 
        width:  70%;
        color: black;
        opacity: 0.8;
        background: white;
        text-align:center;
        text-align:left;
    }
    div{
        margin-bottom: 0.5px;
    }
    input{
        border: 0.5px solid black;
        border: none;
        background: #DCDCDC;
    }
    button {
        background-color: black;
        border: none;
        color: white;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: auto;
        cursor: pointer;
}
</style>
 </html>