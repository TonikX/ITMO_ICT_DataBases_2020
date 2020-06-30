<head>
<style>
        body {
            background-color: #FFFFE0;
        }

</style>

</head>

<?php
echo "<h2>print<h2>";
$link_address = 'index.php';
	echo "<a href='$link_address'>go back</a>";
     
	$host = "localhost";
	$user = "postgres";
	$password = "54Ab62";
	$name = "newspapers";
	$table = "newspapers.print";
	$db = pg_connect("host=$host dbname=$name user=$user password=$password");
        $query = "SELECT * FROM $table";
	$result = pg_fetch_all(pg_query($db, $query));
	$status = ""; 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where 
\"print_id\"='$_POST[print_id]'";
             $status = "Deleted";
         }
         if (isset($_POST["Update"])) {
             $query = "update $table set \"print_id\"='$_POST[print_id]', \"printery_name\"='$_POST[printery_name]', \"party_number\"='$_POST[party_number]', \"print_amount\"='$_POST[print_amount]'";
             $status = "Updated";
         }

         if (isset($_POST["Add"])) {
             $query = "insert into $table values ('$_POST[print_id]', '$_POST[printery_name]', '$_POST[party_number]', '$_POST[print_amount]')";
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
     <label>Print ID: <input name="print_id"> </label>
 <Br> 
    <label>Printery: <input name="printery_name"> </label>
 <Br>
    <label>Party number: <input name="party_number"> </label> 
 <Br>
<label>	Amount of newspapers: <input name="print_amount" > </label>
 <Br>    
 <button type="submit" name="Delete">Delete</button>
 <button type="submit" name="Update">Edit</button>
 <button type="submit" name="Add">Add to database</button>
 </form>
 <?php echo $status ?>
 </body>
 </html> 
