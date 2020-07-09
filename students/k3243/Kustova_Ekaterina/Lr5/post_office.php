<head>
<style>
        body {
            background-color: #FFFFE0;
        }

</style>

</head>

<?php
echo "<h2>post office<h2>";
$link_address = 'index.php';
	echo "<a href='$link_address'>go back</a>";

       $host = "localhost";
	$user = "postgres";
	$password = "54Ab62";
	$name = "newspapers";
	$table = "newspapers.post_office";
	$db = pg_connect("host=$host dbname=$name user=$user password=$password");
        $query = "SELECT * FROM $table";
	$result = pg_fetch_all(pg_query($db, $query));
	$status = ""; 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where \"office¹\"='$_POST[office¹]'";
             $status = "Deleted";
         }

	 if (isset($_POST["Update"])) {
             $query = "update $table set \"office¹\"='$_POST[office¹]', \"office_address\"='$_POST[office_address]' where \"office¹\"='$_POST[office¹]'";
             $status = "Updated";
         }

         if (isset($_POST["Add"])) {
             $query = "insert into $table values ('$_POST[office¹]', '$_POST[office_address]')";
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
     <label>Number of post office: <input name="office¹"> </label>
 <Br> 
    <label>Address of post office: <input name="office_address"> </label>
 <Br>
 <button type="submit" name="Delete">Delete</button>
 <button type="submit" name="Update">Edit</button>
 <button type="submit" name="Add">Add to database</button>
 </form>
 <?php echo $status ?>
 </body>
 </html> 
