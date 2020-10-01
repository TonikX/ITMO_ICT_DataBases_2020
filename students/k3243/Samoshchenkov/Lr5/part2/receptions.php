<?php
echo "<title>Приёмы</title>";


 	$dbuser = 'postgres';
	$dbpass = '123456789';
	$host = '127.0.0.1';
	$dbport = '5433';
	$dbname= 'lab3';
	$table = '"Clinic"."Reception"';
	$db = pg_connect("host=$host port=$dbport dbname=$dbname user=$dbuser
	password=$dbpass");
 	$query = "select * from $table";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where ID_reception='$_POST[ID_reception]'";
             $status = "Deleted";
         }

         if (isset($_POST["Add"])) {
             $query = "insert into $table values ('$_POST[ID_reception]', '$_POST[FK_ID_Price]', '$_POST[FK_ID_room]', '$_POST[FK_ID_med_book]', '$_POST[FK_ID_Doctor]', '$_POST[Reception_Date_Time]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set ID_reception='$_POST[ID_reception]', FK_ID_Price='$_POST[FK_ID_Price]', FK_ID_room='$_POST[FK_ID_room]', FK_ID_med_book='$_POST[FK_ID_med_book]', FK_ID_Doctor='$_POST[FK_ID_Doctor]', Reception_Date_Time='$_POST[Reception_Date_Time]' WHERE ID_reception='$_POST[ID_reception]'";
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
     <label><input name="ID_reception" placeholder="001"> - Идентификатор приёма </label>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <input name="ID_reception" size="15" placeholder="001"> - Идентификатор приёма <Br>
     <input name="FK_ID_Price" size="15"  placeholder="001"> - Идентификатор услуги <Br>
	 <input name="FK_ID_room" size="15" placeholder="001"> - Идентификатор кабинета <Br>
     <input name="FK_ID_med_book" size="15" placeholder="001"> - Идентификатор медицинской карты <Br>
     <input name="FK_ID_Doctor" size="15" placeholder="001"> - Идентификатор врача	 <Br>
     <input name="Reception_Date_Time" size="15" placeholder="15-01-2020 08:00"> - Дата и время приёма<Br>	 	 
     <button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html> 
