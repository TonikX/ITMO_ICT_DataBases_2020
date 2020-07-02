<?php
echo "<title>Заявки</title>";


 	$dbuser = "postgres";
 	$dbpass = "batya";
 	$host = "localhost";
 	$dbname= "Enrolling_Comission";
 	$table = 'enroll_comission."Application"';
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
             $query = "insert into $table values ('$_POST[ID]',
             '$_POST[Enrolee_ID]',
             '$_POST[Course_ID]', 
             '$_POST[Application_date]', 
             '$_POST[Status]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set 
                \"Enrolee_ID\"='$_POST[Enrolee_ID]',
                \"Course_ID\"='$_POST[Course_ID]',
                \"Application_date\"='$_POST[Application_date]',
                \"Status\"='$_POST[Status]' 
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
     <label><input name="ID" placeholder="123"> - Идентификатор заявки (ID) </label>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <input name="ID" size="15" placeholder="123"> - Идентификатор заявки (ID) <Br>
     <input name="Enrolee_ID" size="15"  placeholder="123"> - Идентификатор абитуриента (Enrolee_ID) <Br>
	 <input name="Course_ID" size="15" placeholder="123"> - Идентификатор направления (Course_ID) <Br>    
	 <input name="Application_date" type="date" size="15" placeholder="2020-20-12"> - Дата подачи заявки (Application_date) <Br> 
	 <input name="Status" size="15" placeholder="Approved/Rejected/In process"> - Статус заявки (Status) <Br> 
     <button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html> 

<a href = 'index.php'>Домой</a>