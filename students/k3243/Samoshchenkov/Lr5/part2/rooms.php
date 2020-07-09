<?php
echo "<title>Кабинеты</title>";


 	$dbuser = 'postgres';
	$dbpass = '123456789';
	$host = '127.0.0.1';
	$dbport = '5433';
	$dbname= 'lab3';
	$table = '"Clinic"."Room"';
	$db = pg_connect("host=$host port=$dbport dbname=$dbname user=$dbuser
	password=$dbpass");
 	$query = "select * from $table";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where ID_room='$_POST[ID_room]'";
             $status = "Deleted";
         }

         if (isset($_POST["Add"])) {
             $query = "insert into $table values ('$_POST[ID_room]', '$_POST[Room_num]', '$_POST[Room_working_time]', '$_POST[Responsible_name]', '$_POST[responsible_telephone]', '$_POST[inner_telephone]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set ID_room='$_POST[ID_room]', Room_num='$_POST[Room_num]', Room_working_time='$_POST[Room_working_time]', Responsible_name='$_POST[Responsible_name]', responsible_telephone='$_POST[responsible_telephone]', inner_telephone='$_POST[inner_telephone]' WHERE ID_room='$_POST[ID_room]'";
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
     <label><input name="ID_room" placeholder="001"> - Идентификатор кабинета </label>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <input name="ID_room" size="15" placeholder="001"> - Идентификатор кабинета <Br>
     <input name="Room_num" size="15"  placeholder="15"> - Номер кабинета <Br>
	 <input name="Room_working_time" size="15" placeholder="08:00-20:00"> - Рабочее время кабинета <Br>
     <input name="Responsible_name" size="15" placeholder="Ivanov Ivan Ivanowitch"> - Ответственное лицо <Br>
     <input name="responsible_telephone" size="15" placeholder="89206544789"> - Телефон ответственного лица	 <Br>
     <input name="inner_telephone" size="15" placeholder="302009"> - Внутренний телефон<Br>	 	 
     <button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html> 
