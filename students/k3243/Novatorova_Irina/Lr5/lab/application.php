<!DOCTYPE html>
<html>
<head>
    <h2 align="center">Заявки</h2>
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
        width: 60%;
        margin: auto;
        border: 1px solid white;
        border-collapse:collapse;
        text-align:center;
        font-size: 12px;
        table-layout: fixed;
        background: white;
        opacity: 0.8;
        color: black;
        margin-top: 30px;
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
 	$table = '"luch"."application"';
 	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
 	password=$dbpass");
 	$query = "select * from $table";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where \"id_application\"='$_POST[id_application]'";
             $status = "Deleted";
         }
 
         if (isset($_POST["Add"])) {
             $query = "insert into $table (id_application, id_service, id_client, date_application, ad_product, status, amount) VALUES ('$_POST[id_application]', 
             '$_POST[id_service]',
             '$_POST[id_client]', 
             '$_POST[date_application]',
             '$_POST[ad_product]',
             '$_POST[status]',
             '$_POST[amount]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set \"id_service\"='$_POST[id_service]', 
             \"id_client\"='$_POST[id_client]', 
             \"date_application\"='$_POST[date_application]',
             \"ad_product\"='$_POST[ad_product]',
             \"status\"='$_POST[status]',
             \"amount\"='$_POST[amount]' 
             where \"id_application\"='$_POST[id_application]'";
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
     <input name="id_application" placeholder="1"> - Номер заявки <Br>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <h3>Добавить/редактировать данные</h3>
     <input name="id_application" placeholder="1"> - Номер заявки <Br>
     <input name="id_service" placeholder="1"> - Номер услуги <Br>
     <input name="id_client" placeholder="1"> - Номер клиента <Br>
	 <input name="date_application" placeholder="2020-02-20"> - Дата заявки <Br>
     <input name="ad_product" placeholder="widescreen banner"> - Рекламный продукт <Br>
     <input name="status" placeholder="completed"> - Статус <Br>
     <input name="amount" placeholder="10 banners"> - Объем заказа <Br>   
	<button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html>
