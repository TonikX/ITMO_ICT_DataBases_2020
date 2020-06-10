<?php

 	$dbuser = "postgres";
 	$dbpass = "???";
 	$host = "localhost";
 	$dbname= "PoultryFarm";
 	$table = '"PoultryFarm"."Chicken"';
 	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
 	password=$dbpass");
 	$query = "select * from $table";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where \"ID_chicken\"='$_POST[ID_chicken]'";
             $status = "Deleted";
         }
 
         if (isset($_POST["Add"])) {
             $query = "insert into $table values ('$_POST[weight]', '$_POST[number_tsekh]', '$_POST[number_row]', '$_POST[ID_cell]', '$_POST[age]', '$_POST[eggs_per_month]', '$_POST[ID_breed]', '$_POST[ID_chicken]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {
             $query = "Update $table set \"weight\"='$_POST[weight]', \"number_tsekh\"='$_POST[number_tsekh]', \"number_row\"='$_POST[number_row]', \"ID_cell\"='$_POST[ID_cell]', \"age\"='$_POST[age]', \"eggs_per_month\"='$_POST[eggs_per_month]', \"ID_breed\"='$_POST[ID_breed]' where \"ID_chicken\"='$_POST[ID_chicken]'";
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
     <label><input name="ID_chicken" placeholder="1"> - ID_chicken (ID курицы) </label>
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <input name="weight" size="40" placeholder="3"> - weight (вес) <Br>
     <input name="number_tsekh" size="40" placeholder="1"> - number_tsekh (номер цеха) <Br>
	 <input name="number_row" size="40" placeholder="12"> - number_row (номер ряда) <Br>    
	 <input name="ID_cell" size="40" placeholder="3"> - ID_cell (ID клетки) <Br>
	 <input name="age" size="40" placeholder="4"> - age (возраст) <Br>
	 <input name="eggs_per_month" size="40" placeholder="17"> - eggs_per_month (яйца в месяу) <Br>
	 <input name="ID_breed" size="40" placeholder="2"> - ID_breed (ID породы) <Br>
	 <input name="ID_chicken" size="40" placeholder="1"> - ID_chicken (ID курицы) <Br>
     <button type="submit" name="Add">Добавить</button>
 	<button type="submit" name="Update">Редактировать</button>
 </form>
 <?php echo $status ?>
 </body>
 </html>