<?php
echo "<title>Пациенты</title>";


 	$dbuser = 'postgres';
	$dbpass = '123456789';
	$host = '127.0.0.1';
	$dbport = '5433';
	$dbname= 'lab3';
	$table = '"Clinic"."Medical_book"';
	$db = pg_connect("host=$host port=$dbport dbname=$dbname user=$dbuser
	password=$dbpass");
 	$query = "select * from $table";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where ID_med_book='$_POST[ID_med_book]'";
             $status = "Deleted";
         }

         if (isset($_POST["Add"])) {
             $query = "insert into $table values ('$_POST[ID_med_book]', '$_POST[FK_ID_Diagnose]', '$_POST[Owner_name]', '$_POST[Owner_sex]', '$_POST[Owner_date_of_birth]', '$_POST[Owner_telephone]', '$_POST[Receptions]', '$_POST[FK_ID_patient]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set ID_med_book='$_POST[ID_med_book]', FK_ID_Diagnose='$_POST[FK_ID_Diagnose]', Owner_name='$_POST[Owner_name]', Owner_sex='$_POST[Owner_sex]', Owner_date_of_birth='$_POST[Owner_date_of_birth]', Owner_telephone='$_POST[Owner_telephone]', Receptions='$_POST[Receptions]', FK_ID_patient='$_POST[FK_ID_patient]' WHERE ID_med_book='$_POST[ID_med_book]'";
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
     <label><input name="ID_med_book" placeholder="001"> - Идентификатор медицинской карты </label>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <input name="ID_med_book" size="15" placeholder="001"> - Идентификатор медицинской карты <Br>
     <input name="FK_ID_Diagnose" size="15"  placeholder="Ivanov Eldar Genadievich"> - Идентификатор диагноза <Br>
	 <input name="Owner_name" size="15" placeholder="attack helicopter"> - Имя владельца карты <Br>
     <input name="Owner_sex" size="15" placeholder="19-05-1990"> - Пол владельца <Br>
     <input name="Owner_date_of_birth" size="15" placeholder="5404 789459"> - Дата рождения владельца <Br>
     <input name="Owner_telephone" size="15" placeholder="11111111111"> - Телефон владельца <Br>
     <input name="Receptions" size="15" placeholder="89103217799"> - Приёмы <Br>
     <input name="FK_ID_patient" size="15" placeholder="89103217799"> - Идентификатор пациента <Br> 	 
     <button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html> 
