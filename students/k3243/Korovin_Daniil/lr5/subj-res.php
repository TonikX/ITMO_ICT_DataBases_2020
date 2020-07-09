<?php
echo "<title>Результаты по дисциплинам</title>";


 	$dbuser = "postgres";
 	$dbpass = "batya";
 	$host = "localhost";
 	$dbname= "Enrolling_Comission";
 	$table = 'enroll_comission."Subj_res"';
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
             $query = "insert into $table values ('$_POST[ID]', '$_POST[Name]', '$_POST[Grade]', '$_POST[isProfile]', '$_POST[School_sertificate_ID]', '$_POST[EGE_sertificate_ID]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set 
             \"Name\"='$_POST[Name]', 
             \"Grade\"='$_POST[Grade]', 
             \"isProfile\"='$_POST[isProfile]', 
             \"School_sertificate_ID\"='$_POST[School_sertificate_ID]', 
             \"EGE_sertificate_ID\"='$_POST[EGE_sertificate_ID]'
             WHERE \"ID\"='$_POST[ID]'";
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
     <label><input name="ID" placeholder="123"> - Идентификатор предмета (ID) </label>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <input name="ID" size="15" placeholder="123"> - Идентификатор предмета (ID) <Br>
     <input name="Name" size="15" placeholder="Biology"> - Название предмета (Name) <Br>
     <input name="Grade" size="15" placeholder="5"> - Оценка (Grade) <Br>
     <input name="isProfile" size="15" placeholder="true/false"> - профильность предмета (isProfile) <Br>
     <input name="School_sertificate_ID" size="15" placeholder="125"> - Идентификатор аттестата (School_sertificate_ID) <Br>
     <input name="EGE_sertificate_ID" size="15" placeholder="213"> - Идентификатор сертификата ЕГЭ(EGE_sertificate_ID) <Br>
     <button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html> 

<a href = 'index.php'>Домой</a>