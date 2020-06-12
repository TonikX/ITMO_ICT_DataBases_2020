<?php
echo "<title>Паспортные данные</title>";


 	$dbuser = "postgres";
 	$dbpass = "batya";
 	$host = "localhost";
 	$dbname= "Enrolling_Comission";
 	$table = 'enroll_comission."Passport"';
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
             $query = "insert into $table values ('$_POST[ID]', '$_POST[Issue_date]', '$_POST[Issued_by]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set \"ID\"='$_POST[ID]', \"Issue_date\"='$_POST[Issue_date]', \"Issued_by\"='$_POST[Issued_by]'";
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
     <label><input name="ID" placeholder="4112666666"> - Номер паспорта (ID) </label>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <input name="ID" size="15" placeholder="4112666666"> - Номер паспорта (ID) <Br>
     <input name="Issue_date" type = "date" size="40" placeholder="2001-09-11"> - Дата выдачи (Issue_date) <Br>
	 <input name="Issued_by" size="15" placeholder="MVD RF"> - Кем выдан (Issued_by) <Br>    
     <button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html> 

<a href = 'index.php'>Домой</a>