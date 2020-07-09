<?php
echo "<title>Расписание</title>";


 	$dbuser = 'postgres';
	$dbpass = '123456789';
	$host = '127.0.0.1';
	$dbport = '5433';
	$dbname= 'lab3';
	$table = '"Clinic"."Schedule"';
	$db = pg_connect("host=$host port=$dbport dbname=$dbname user=$dbuser
	password=$dbpass");
 	$query = "select * from $table";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where ID_schedule='$_POST[ID_schedule]'";
             $status = "Deleted";
         }

         if (isset($_POST["Add"])) {
             $query = "insert into $table values ('$_POST[ID_schedule]', '$_POST[Day_of_week]', '$_POST[Working_status]', '$_POST[Working_time]', '$_POST[FK_ID_Doctor]'";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set ID_schedule='$_POST[ID_schedule]', Day_of_week='$_POST[Day_of_week]', Working_status='$_POST[Working_status]', Working_time='$_POST[Working_time]', FK_ID_Doctor='$_POST[FK_ID_Doctor]' WHERE ID_schedule'$_POST[ID_schedule]";
             $status = "Updated";
         }
         pg_query($query);
         echo "<meta http-equiv='refresh' content='0'>";
     }

     pg_close($db);
 ?>

 <a href = 'index.php'>Главная страница</a> 
 
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
     <label><input name="ID_patient" placeholder="001"> - Идентификатор пациента </label>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <input name="ID_schedule" size="15" placeholder="001"> - Идентификатор расписания <Br>
     <input name="Day_of_week" size="15"  placeholder="1"> - День недели <Br>
	 <input name="Working_status" size="15" placeholder="1"> - Статус <Br>
     <input name="Working_time" size="15" placeholder="08:00-14:00"> - Время работы <Br>
     <input name="FK_ID_Doctor" size="15" placeholder="001"> - Идентификатор врача<Br>	 
     <button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html> 
