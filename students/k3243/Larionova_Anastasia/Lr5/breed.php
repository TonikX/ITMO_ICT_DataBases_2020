<?php

 	$dbuser = "postgres";
 	$dbpass = "???";
 	$host = "localhost";
 	$dbname= "PoultryFarm";
 	$table = '"PoultryFarm"."Breed"';
 	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
 	password=$dbpass");
 	$query = "select * from $table";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where \"ID_breed\"='$_POST[ID_breed]'";
             $status = "Deleted";
         }
 
         if (isset($_POST["Add"])) {
             $query = "insert into $table values ('$_POST[name]', '$_POST[weight_avg]', '$_POST[productivity]', '$_POST[number_recommended]', '$_POST[diet]', '$_POST[ID_breed]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set \"name\"='$_POST[name]', \"weight_avg\"='$_POST[weight_avg]', \"productivity\"='$_POST[productivity]', \"number_recommended\"='$_POST[number_recommended]', \"diet\"='$_POST[diet]' where \"ID_breed\"='$_POST[ID_breed]'";
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
     <label><input name="ID_breed" placeholder="1"> - ID_breed (ID породы) </label>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <input name="name" size="40" placeholder="Australop"> - name (название породы) <Br>
     <input name="weight_avg" size="40" placeholder="3"> - weight_avg (средний вес) <Br>
	 <input name="productivity" size="40" placeholder="24"> - productivity (производительность) <Br>    
	 <input name="number_recommended" size="40" placeholder="17"> - number_recommended (номер рекомендованной) <Br>
	 <input name="diet" size="40" placeholder="Fruit"> - diet (питание) <Br>
	 <input name="ID_breed" size="40" placeholder="1"> - ID_breed (ID породы) <Br>
     <button type="submit" name="Add">Добавить</button>
 	 <button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html>