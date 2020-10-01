<!DOCTYPE html>
<html>
<head>
    <h2 align="center">Прайс-лист на услуги</h2>
    <form> 
    <p><button formaction="index.php">На главную</button></p>
    </form>
</head>
<style>
    body{
        background-color: powderblue;
        background-size: cover;
    }
    table, td, th{
        width: 50%;
        margin: auto;
        border: 1px solid white;
        border-collapse:collapse;
        text-align:center;
        font-size: 15px;
        table-layout: fixed;
        background: white;
        opacity: 0.8;
        color: black;
        margin-top: 50px;
}
    th, td {
        padding: 10px;
    }
</style>
<?php
 	$dbuser = "postgres";
 	$dbpass = "IF875H";
 	$host = "localhost";
 	$dbname= "luch";
 	$table = '"luch"."price_list"';
 	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
 	password=$dbpass");
 	$query = "select * from $table";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where \"id_service\"='$_POST[id_service]'";
             $status = "Deleted";
         }
 
         if (isset($_POST["Add"])) {
             $query = "insert into $table (id_service, price, type_service) VALUES ('$_POST[id_service]', 
             '$_POST[price]', 
             '$_POST[type_service]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set \"price\"='$_POST[price]', 
             \"type_service\"='$_POST[type_service]'
             where \"id_service\"='$_POST[id_service]'";
             $status = "Updated";
         }
         pg_query($query);
         echo "<meta http-equiv='refresh' content='0'>";
     }

     pg_close($db);
 ?>

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

 <body>
 <form action="" method="post">
    <h3>Удалить позицию из базы</h3>
     <input name="id_service" placeholder="1"> - Номер услуги <Br>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <h3>Добавить/редактировать данные</h3>
     <input name="id_service"  placeholder="1"> - Номер услуги <Br>
     <input name="price" placeholder="1500"> - Цена за единицу <Br>
     <input name="type_service" placeholder="banner"> - Вид услуги <Br>   
	<button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html>