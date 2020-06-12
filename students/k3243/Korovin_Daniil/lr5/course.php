<?php
echo "<title>Школы</title>";


 	$dbuser = "postgres";
 	$dbpass = "batya";
 	$host = "localhost";
 	$dbname= "Enrolling_Comission";
 	$table = 'enroll_comission."Course"';
 	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
 	password=$dbpass");
 	$query = "select * from $table";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where \"ID\"='$_POST[ID]'";
             $status = "Deleted";
         }

         if (isset($_POST["Add"])) {
             $query = "insert into $table values ('$_POST[ID]', '$_POST[Name]', '$_POST[Available_slots]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set \"ID\"='$_POST[ID]', \"Name\"='$_POST[Name]', \"Available_slots\"='$_POST[Available_slots]'";
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
     <label><input name="ID" placeholder="123"> - Идентификатор направления (ID) </label>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <input name="ID" size="15" placeholder="123"> - Идентификатор направления (ID) <Br>
     <input name="Name" size="15"  placeholder="Gender studies"> - Название направления (Name) <Br>
	 <input name="Available_slots" size="15" placeholder="322"> - Количество мест (Available_slots) <Br>    
     <button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html> 

<a href = 'index.php'>Домой</a>