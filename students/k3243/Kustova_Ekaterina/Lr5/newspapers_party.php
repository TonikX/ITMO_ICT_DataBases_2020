<head>
<style>
        body {
            background-color: #FFFFE0;
        }

</style>

</head>

<?php
echo "<h2>newspapers party<h2>";
$link_address = 'index.php';
	echo "<a href='$link_address'>go back</a>";

        $host = "localhost";
	$user = "postgres";
	$password = "54Ab62";
	$name = "newspapers";
	$table = "newspapers.newspapers_party";
	$db = pg_connect("host=$host dbname=$name user=$user password=$password");
        $query = "SELECT * FROM $table";
	$result = pg_fetch_all(pg_query($db, $query));
	$status = ""; 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

         if (isset($_POST["Delete"])) {
             $query = "delete from $table where \"party_number\"='$_POST[party_number]'";
             $status = "Deleted";
         }

	if (isset($_POST["Update"])) {
             $query = "update $table set \"party_number\"='$_POST[party_number]', \"newspapers_name\"='$_POST[newspapers_name]', \"amount_of_copies\"='$_POST[amount_of_copies]' where \"party_number\"='$_POST[party_number]'";
             $status = "Updated";
         }

       if (isset($_POST["Add"])) {
             $query = "insert into $table values ('$_POST[party_number]', '$_POST[newspapers_name]', '$_POST[amount_of_copies]')";
             echo $query;
             $status = "Added";
         }

	
         pg_query($query);
         echo "<meta http-equiv='refresh' content='0'>";
     }
     	pg_close($db);

?>

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
     <label>Party number: <input name="party_number"> </label>
 <Br> 
    <label>Newspaper: <input name="newspapers_name"> </label>
 <Br>
    <label>Amount of copies: <input name="amount_of_copies" > </label> 
 <Br>
 <button type="submit" name="Delete">Delete</button>
 <button type="submit" name="Update">Edit </button>
 <button type="submit" name="Add">Add to database</button>
 </form>
 <?php echo $status ?>
 </body>
 </html> 