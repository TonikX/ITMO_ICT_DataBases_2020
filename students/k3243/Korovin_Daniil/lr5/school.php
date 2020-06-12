<?php
echo "<title>Школы</title>";


 	$dbuser = "postgres";
 	$dbpass = "batya";
 	$host = "localhost";
 	$dbname= "Enrolling_Comission";
 	$table = 'enroll_comission."School"';
 	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
 	password=$dbpass");
 	$query = "select * from $table";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where \"Name\"='$_POST[Name]'";
             $status = "Deleted";
         }

         if (isset($_POST["Add"])) {
             $query = "insert into $table values ('$_POST[Name]', '$_POST[Graduation_date]', '$_POST[School_location]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set \"Name\"='$_POST[Name]', \"Graduation_date\"='$_POST[Graduation_date]', \"School_location\"='$_POST[School_location]'";
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
     <label><input name="ID" placeholder="School #359"> - Название школы (Name) </label>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <input name="Name" size="15" placeholder="School #359"> - Название школы (Name) <Br>
     <input name="Graduation_date" size="40" type = "date"  placeholder="2001-09-11"> - Дата выпуска (Graduation_date) <Br>
	 <input name="School_location" size="15" placeholder="Moscow"> - Расположение школы (School_location) <Br>    
     <button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html> 

<a href = 'index.php'>Домой</a>