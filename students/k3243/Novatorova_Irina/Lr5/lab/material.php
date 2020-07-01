<!DOCTYPE html>
<html>
<head>
    <form> 
    <p><button formaction="index.php">На главную</button></p>
    </form>
    <h2 align="center">Список материалов</h2>
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
 	$table = '"luch"."material"';
 	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
 	password=$dbpass");
 	$query = "select * from $table";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where \"id_material\"='$_POST[id_material]'";
             $status = "Deleted";
         }
 
         if (isset($_POST["Add"])) {
             $query = "insert into $table (id_material, type_material, name_material, characteristics) VALUES ('$_POST[id_material]', 
             '$_POST[type_material]',
             '$_POST[name_material]', 
             '$_POST[characteristics]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set \"type_material\"='$_POST[type_material]', 
             \"name_material\"='$_POST[name_material]', 
             \"characteristics\"='$_POST[characteristics]' 
             where \"id_material\"='$_POST[id_material]'";
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
     <input name="id_material" placeholder="1"> - Номер материала <Br>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <h3>Добавить/редактировать данные</h3>
     <input name="id_material" placeholder="1"> - Номер материала <Br>
     <input name="type_material" placeholder="photo paper"> - Тип материала <Br>
     <input name="name_material" placeholder="backlit"> - Название материала <Br>
	 <input name="characteristics" placeholder="matte"> - Характеристики <Br>    
	<button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html>
