<?php

 	$dbuser = "postgres";
 	$dbpass = "???";
 	$host = "localhost";
 	$dbname= "PoultryFarm";
 	$table = '"PoultryFarm"."Tsekh"';
 	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
 	password=$dbpass");
 	$query = "select * from $table order by number_tsekh asc";
 	$result = pg_fetch_all(pg_query($db, $query));
 	$status = "";

 	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where \"number_tsekh\"='$_POST[number_tsekh]'";
             $status = "Deleted";
         }
 
         if (isset($_POST["Add"])) {
             $query = "insert into $table values ('$_POST[number_tsekh]', '$_POST[amount_rows]')";
             echo $query;
             $status = "Added";
         }

         if (isset($_POST["Update"])) {

             $query = "Update $table set \"amount_rows\"='$_POST[amount_rows]' where \"number_tsekh\"='$_POST[number_tsekh]'";
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
     <input name="number_tsekh" placeholder="1"> - number_tsekh (номер цеха)
     <button type="submit" name="Delete">Удалить</button>
 </form>
 <form action="" method="post">
     <input name="number_tsekh" size="40" placeholder="6"> - number_tsekh (номер цеха) <Br>
     <input name="amount_rows" size="40" placeholder="15"> - amount_rows (количество рядов) <Br>
     <button type="submit" name="Add">Добавить</button>
	 <button type="submit" name="Update">Редактировать</button>

 </form>
 <?php echo $status ?>
 </body>
 </html> 