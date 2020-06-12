<?php
echo "<title>Абитуриенты</title>";


 	$dbuser = "postgres";
 	$dbpass = "batya";
 	$host = "localhost";
 	$dbname= "Enrolling_Comission";
 	$table = 'enroll_comission."Enrolee"';
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
             $query = "insert into $table values ('$_POST[ID]', '$_POST[Name]', '$_POST[Passport_ID]', '$_POST[Budget]', '$_POST[Privileges]', '$_POST[Target]', '$_POST[School_name]', '$_POST[School_sertificate_ID]', '$_POST[EGE_sertificate_ID]', '$_POST[Medal_ID]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set \"ID\"='$_POST[ID]', \"Name\"='$_POST[Name]', \"Passport_ID\"=$_POST[Passport_ID]', \"Budget\"='$_POST[Budget]', \"Privileges\"='$_POST[Privileges]', \"Target\"='$_POST[Target]', \"School_name\"='$_POST[School_name]', \"School_sertificate_ID\"='$_POST[School_sertificate_ID]', \"EGE_sertificate_ID\"='$_POST[EGE_sertificate_ID]', \"Medal_ID\"='$_POST[Medal_ID]'";
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
     <label><input name="ID" placeholder="123"> - Идентификатор абитуриента (ID) </label>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <input name="ID" size="15" placeholder="123"> - Идентификатор абитуриента (ID) <Br>
     <input name="Name" size="15" placeholder="Vladimir Georgievich Sorokin"> - ФИО (Name) <Br>
     <input name="Passport_ID" size="15" placeholder="4113767676"> - Серия и номер паспорта (Passport_ID) <Br>
     <input name="Budget" size="15" placeholder="true/false"> - Форма обучения (бюджетник - true, контрактник - false) (Budget) <Br>
     <input name="Privileges" size="15" placeholder="true/false"> - Наличие льгот (Privileges) <Br>
     <input name="Target" size="15" placeholder="true/false"> - Наличие целевого направления (Target) <Br>
     <input name="School_name" size="15" placeholder="School #42"> - Название школы (School_name) <Br>
     <input name="School_sertificate_ID" size="15" placeholder="123"> - Идентификатор аттестата (School_sertificate_ID) <Br>
     <input name="EGE_sertificate_ID" size="15" placeholder="123"> - Идентификатор сертификата ЕГЭ (EGE_sertificate_ID) <Br>
     <input name="Medal_ID" size="15" placeholder="123"> - Идентификатор медали (если есть) (Medal_ID) <Br>
     <button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html> 

<a href = 'index.php'>Домой</a>