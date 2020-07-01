<!DOCTYPE html>
<html>
<head>
    <h2 align="center">Список сотрудников</h2>
    <form> 
    <p><button formaction="index.php">На главную</button></p>
    </form>
</head>
<style>
    body{
        background-color: powderblue;
    }
    table, td, th{
        width: 50%;
        margin: auto;
        border: 1px solid white;
        border-collapse:collapse;
        text-align:center;
        font-size: 12px;
        table-layout: fixed;
        background: white;
        opacity: 0.8;
        color: black;
        margin-top: 40px;
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
 	$table = '"luch"."worker"';
 	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
 	password=$dbpass");
 	$query = "select * from $table";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where \"id_number\"='$_POST[id_number]'";
             $status = "Deleted";
         }
 
         if (isset($_POST["Add"])) {
             $query = "insert into $table (id_number, name, contacts, work_experience) VALUES 
             ('$_POST[id_number]', 
             '$_POST[name]',
             '$_POST[contacts]', 
             '$_POST[work_experience]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set \"name\"='$_POST[name]', 
             \"contacts\"='$_POST[contacts]', 
             \"work_experience\"='$_POST[work_experience]' 
             where \"id_number\"='$_POST[id_number]'";
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
    <h3>Удалить данные сотрудника из базы</h3>
     <input name="id_number" placeholder="1"> - Номер сотрудника <Br>
     <button type="submit" name="Delete">Удалить</button>
     </form>
 <form action="" method="post">
     <h3>Добавить/редактировать данные</h3>
     <input name="id_number" placeholder="1"> - Номер сотрудника <Br>
     <input name="name" placeholder="Ivan Ivanov"> - ФИ сотрудника <Br>
     <input name="contacts" placeholder="+79991110011"> - Номер телефона сотрудника <Br>
	 <input name="work_experience"  placeholder="10"> - Стаж работы <Br>    
	<button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html>
