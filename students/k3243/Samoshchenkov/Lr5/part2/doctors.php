<?php
echo "<title>Врачи</title>";


 	$dbuser = 'postgres';
	$dbpass = '123456789';
	$host = '127.0.0.1';
	$dbport = '5433';
	$dbname= 'lab3';
	$table = '"Clinic"."Doctor"';
	$db = pg_connect("host=$host port=$dbport dbname=$dbname user=$dbuser
	password=$dbpass");
 	$query = "select * from $table";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where ID_patient='$_POST[ID_doctor]'";
             $status = "Deleted";
         }

         if (isset($_POST["Add"])) {
             $query = "insert into $table values ('$_POST[ID_doctor]', '$_POST[Doctor_name]', '$_POST[Specialization]', '$_POST[Doctor_Date_of_birth]', '$_POST[FK_ID_Specialization]', '$_POST[Doctor_sex]', '$_POST[TD_data]', '$_POST[First_working_days]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set ID_doctort='$_POST[ID_doctor]', Doctor_name='$_POST[Doctor_name]', Specialization='$_POST[Specialization]', Doctor_Date_of_birth='$_POST[Doctor_Date_of_birth]', FK_ID_Specialization='$_POST[FK_ID_Specialization]', Doctor_sex='$_POST[Doctor_sex]', TD_data='$_POST[TD_data]', TD_data='$_POST[TD_data]', First_working_days='$_POST[First_working_days]' WHERE ID_patient='$_POST[ID_doctor]'";
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
     <label><input name="ID_doctor" placeholder="001"> - Идентификатор пациента </label>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <input name="ID_doctor" size="15" placeholder="001"> - Идентификатор пациента <Br>
     <input name="Doctor_name" size="15"  placeholder="Ivanov Eldar Genadievich"> - ФИО врача <Br>
	 <input name="Specialization" size="15" placeholder="attack helicopter"> - Специализация <Br>
     <input name="Doctor_Date_of_birth" size="15" placeholder="19-05-1990"> - Дата рождения врача <Br>
     <input name="FK_ID_Specialization" size="15" placeholder="001"> - Идентификатор специализации <Br>
     <input name="Doctor_sex" size="15" placeholder="attack helicopter"> - Пол врача <Br>
     <input name="TD_data" size="15" placeholder="Информация"> - Информация по трудовому договору <Br>
     <input name="First_working_days" size="15" placeholder="12-01-2005"> - Первый рабочий день <Br> 	 
     <button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html> 
