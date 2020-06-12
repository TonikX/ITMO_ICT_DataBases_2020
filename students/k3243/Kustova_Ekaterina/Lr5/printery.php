<head>
<style>
        body {
            background-color: #FFFFE0;
        }

</style>

</head>

<?php
echo "<h2>printery<h2>";
$link_address = 'index.php';
	echo "<a href='$link_address'>go back</a>";

	$host = "localhost";
	$user = "postgres";
	$password = "54Ab62";
	$name = "newspapers";
	$table = "newspapers.printery";
	$db = pg_connect("host=$host dbname=$name user=$user password=$password");
        $query = "SELECT * FROM $table";
	$result = pg_fetch_all(pg_query($db, $query));
	$status = ""; 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where \"printery_name\"='$_POST[printery_name]'";
             $status = "Deleted";
         }
         if (isset($_POST["Update"])) {
             $query = "update $table set \"printery_name\"='$_POST[printery_name]', \"printery_address\"='$_POST[printery_address]', \"opening_time\"='$_POST[opening_time]', \"closing_time\"='$_POST[closing_time]'";
             $status = "Updated";
         }
         if (isset($_POST["Add"])) {
             $query = "insert into $table values ('$_POST[printery_name]', '$_POST[printery_address]', '$_POST[opening_time]', '$_POST[closing_time]')";
             echo $query;
             $status = "Added";
         }
	
         pg_query($query);
         echo "<meta http-equiv='refresh' content='0'>";
     }

     pg_close($db);

?>
     <html>
<table>
<style type="text/css">
   TH {
    background: #000000; 
    color: #fffff0; 
   }
   TD, TH {
    padding: 3px; 
   }
  </style>

     <tr>
       <th><?php echo implode('</th><th>', array_keys($result[0])); ?></th>
     </tr>
   
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
     <label>Printery: <input name="printery_name"> </label>
 <Br> 
    <label>Address of printery: <input name="printery_address"> </label>
 <Br>
    <label>Opening time:  <input name="opening_time"> </label> 
 <Br>
<label>	Closing time: <input name="closing_time"> </label>
 <Br>    
 <button type="submit" name="Delete">Delete</button>
 <button type="submit" name="Update">Edit</button>
 <button type="submit" name="Add">Add to database</button>
 </form>
 <?php echo $status ?>
 </body>
 </html> 