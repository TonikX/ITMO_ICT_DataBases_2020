<head>
<style>

        body {
            background-color: #FFFFE0;
        }

</style>

</head>
<?php
echo "<h2>Requests<h2>";
$link_address = 'index.php';
	echo "<a href='$link_address'>go back</a>";	

	$host = "localhost";
	$user = "postgres";
	$password = "54Ab62";
	$name = "newspapers";
	
$db = pg_connect("host=$host dbname=$name user=$user
password=$password");

$query = "SELECT printery_address
	FROM newspapers.printery 
INNER JOIN newspapers.print ON printery.printery_name = print.printery_name
INNER JOIN newspapers.newspapers_party ON newspapers_party.party_number = print.party_number
WHERE newspapers_name = 'Herald' AND newspapers_party.party_number = 2";


$query1 = "SELECT  CONCAT(newspaper.editors_name, ' ', newspaper.editors_surname )
	FROM newspapers.newspaper
ORDER BY price";
     
$query2 = "SELECT office_address
	FROM newspapers.post_office
UNION
SELECT printery_address
	FROM newspapers.printery";

$query3 = "SELECT newspapers_name, editors_surname, editors_name, index, price
	FROM newspapers.newspaper
	WHERE price > ALL
	(SELECT price FROM newspapers.newspaper WHERE newspapers_name = 'Herald')";
      
$query4 = "SELECT  newspapers_party.newspapers_name, AVG(newspapers_party.amount_of_copies)
FROM  newspapers.newspapers_party
INNER JOIN newspapers.newspaper ON newspapers_party.newspapers_name = newspaper.newspapers_name
GROUP BY newspapers_party.newspapers_name, newspapers_party.amount_of_copies
HAVING AVG(newspapers_party.amount_of_copies) < 3000";
  

$result = pg_fetch_all(pg_query($db, $query));
$result1 = pg_fetch_all(pg_query($db, $query1));
$result2 = pg_fetch_all(pg_query($db, $query2));
$result3 = pg_fetch_all(pg_query($db, $query3));
$result4 = pg_fetch_all(pg_query($db, $query4));

  
pg_close($db);
?>
<h3> Addresses where newspaper "Herald" can be printed: </h3>
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

 <h3> Full names of each editor: </h3>

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
       <th><?php echo implode('</th><th>', array_keys($result1[0])); ?></th>
     </tr>
   <tbody>

 <?php foreach ($result1 as $row): array_map('htmlentities', $row); ?>
     <tr>
       <td><?php echo implode('</td><td>', $row); ?></td>
     </tr>
 <?php endforeach; ?>
   </tbody>
 </table>
 <h3> All addresses: </h3>
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
       <th><?php echo implode('</th><th>', array_keys($result2[0])); ?></th>
     </tr>
  
   <tbody>

 <?php foreach ($result2 as $row): array_map('htmlentities', $row); ?>
     <tr>
       <td><?php echo implode('</td><td>', $row); ?></td>
     </tr>
 <?php endforeach; ?>
   </tbody>
 </table>

 <h3> All information about newspapers that are more expensive than "Herald": </h3>
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
       <th><?php echo implode('</th><th>', array_keys($result3[0])); ?></th>
     </tr>
  
   <tbody>

 <?php foreach ($result3 as $row): array_map('htmlentities', $row); ?>
     <tr>
       <td><?php echo implode('</td><td>', $row); ?></td>
     </tr>
 <?php endforeach; ?>
   </tbody>
 </table>
<h3> Newspapers and average amount of newspapers in party (where < 3000 copies): </h3>

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
       <th><?php echo implode('</th><th>', array_keys($result4[0])); ?></th>
     </tr>
   
   <tbody>

 <?php foreach ($result4 as $row): array_map('htmlentities', $row); ?>
     <tr>
       <td><?php echo implode('</td><td>', $row); ?></td>
     </tr>
 <?php endforeach; ?>
   </tbody>
 </table>
           