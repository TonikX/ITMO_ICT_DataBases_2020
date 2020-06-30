<?php

 	$dbuser = "postgres";
 	$dbpass = "???";
 	$host = "localhost";
 	$dbname= "PoultryFarm";
 	$table = '"PoultryFarm"."Worker"';
 	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
 	password=$dbpass");
 	$query = "select * from $table order by passport";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where \"ID_worker\"='$_POST[ID_worker]'";
             $status = "Deleted";
         }
 
         if (isset($_POST["Add"])) {
             $query = "insert into $table values ('$_POST[passport]', '$_POST[salary]', '$_POST[cells]', '$_POST[ID_worker]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {

             $query = "Update $table set \"passport\"='$_POST[passport]', \"salary\"='$_POST[salary]', \"cells\"='$_POST[cells]' where \"ID_worker\"='$_POST[ID_worker]'";
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
     <input name="ID_worker" placeholder="1"> - ID_worker (ID работника)
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <input name="passport" size="40" placeholder="Fomenko Oxana Georgievna	"> - passport (паспортные данные) <Br>
     <input name="salary" size="40" placeholder="24000"> - salary (зарплата) <Br>
	 <input name="cells" size="40" placeholder="4"> - cells (количество клеток) <Br>
	 <input name="ID_worker" size="40" placeholder="2"> - ID_worker (ID работника) <Br>
     <button type="submit" name="Add">Добавить</button>
	 <button type="submit" name="Update">Редактировать</button>

 </form>
 <?php echo $status ?>
 </body>
 </html> 