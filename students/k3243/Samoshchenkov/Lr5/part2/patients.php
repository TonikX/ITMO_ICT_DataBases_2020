<?php
echo "<title>Пациенты</title>";


 	$dbuser = 'postgres';
	$dbpass = '123456789';
	$host = '127.0.0.1';
	$dbport = '5433';
	$dbname= 'lab3';
	$table = '"Clinic"."Patient"';
	$db = pg_connect("host=$host port=$dbport dbname=$dbname user=$dbuser
	password=$dbpass");
 	$query = "select * from $table";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where ID_patient='$_POST[ID_patient]'";
             $status = "Deleted";
         }

         if (isset($_POST["Add"])) {
             $query = "insert into $table values ('$_POST[ID_patient]', '$_POST[Patient_name]', '$_POST[Patient_sex]', '$_POST[Date_of_birth]', '$_POST[Passport_num]', '$_POST[SNILS_num]', '$_POST[Telephone_num]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set ID_patient='$_POST[ID_patient]', Patient_name='$_POST[Patient_name]', Patient_sex='$_POST[Patient_sex]', Date_of_birth='$_POST[Date_of_birth]', Passport_num='$_POST[Passport_num]', SNILS_num='$_POST[SNILS_num]', Telephone_num='$_POST[Telephone_num]' WHERE ID_patient='$_POST[ID_patient]'";
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
     <input name="ID_patient" size="15" placeholder="001"> - Идентификатор пациента <Br>
     <input name="Patient_name" size="15"  placeholder="Ivanov Eldar Genadievich"> - ФИО пациента <Br>
	 <input name="Patient_sex" size="15" placeholder="attack helicopter"> - Пол пациента <Br>
     <input name="Date_of_birth" size="15" placeholder="19-05-1990"> - Дата рождения пациента <Br>
     <input name="Passport_num" size="15" placeholder="5404 789459"> - Номер паспорта <Br>
     <input name="SNILS_num" size="15" placeholder="11111111111"> - Номер СНИЛС <Br>
     <input name="Telephone_num" size="15" placeholder="89103217799"> - Номер телефона <Br>	 	 
     <button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html> 
