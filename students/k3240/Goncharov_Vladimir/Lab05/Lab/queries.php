<?php
	
	$dbuser = "postgres";
	$dbpass = "root";
	$host = "localhost";
	$dbname= "Lab03";
	$table = 'enroll."School"';
	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
	password=$dbpass");
	$query2 = 'select e."ID", e."Name", p."Number", p."Date", p."IssuedBy" from enroll."Enrollee" e inner join enroll."Passport" p on e."PassportNumber"=p."Number"' ;
    $query1 = 'select e."ID", e."Name", s.* from enroll."Enrollee" e inner join enroll."School" s on e."School"=s."SchooName"' ;
    $query3 = 'select * from enroll."Enrollee" where "Name" != \'Putin Vladimir\' and "ID" != 3' ;
    $query4 = 'select e."ID", e."Name", p."Number", age(current_date, p."Date") as "DateSinceIssue", p."IssuedBy" from enroll."Enrollee" e inner join enroll."Passport" p on e."PassportNumber"=p."Number"' ;
    $query5 = 'select e."School", count(*) as "Amount" from enroll."School" s inner join enroll."Enrollee" e on e."School"=s."SchooName" group by e."School" having count(*)>1' ;
	$result1 = pg_fetch_all(pg_query($db, $query1));
    $result2 = pg_fetch_all(pg_query($db, $query2));
    $result3 = pg_fetch_all(pg_query($db, $query3));
    $result4 = pg_fetch_all(pg_query($db, $query4));
    $result5 = pg_fetch_all(pg_query($db, $query5));


    pg_close($db);
?>


<h2> Вывод имени абитуриента и всех данных о его выпуске из школы. </h2>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($result1[0])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($result1 as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br>
<h2> Вывод имени абитуриента и его паспортных данных </h2>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($result2[0])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($result2 as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br>
<h2>Вывод всех абитуриентов, кроме абитуриента «Putin Vladimir» и абитуриента чей ID равен 3 </h2>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($result3[0])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($result3 as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br>
<h2>Вывод абитуриентов, номера их паспорта и времени, прошедшего со дня выдачи </h2>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($result4[0])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($result4 as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br>
<h2>Вывод школ, где количество выпускников больше 1</h2>>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($result5[0])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($result5 as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>


