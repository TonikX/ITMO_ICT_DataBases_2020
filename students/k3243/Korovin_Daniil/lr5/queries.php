<?php

	$dbuser = "postgres";
	$dbpass = "batya";
	$host = "localhost";
	$dbname= "Enrolling_Comission";
	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
	password=$dbpass");
	
	$query1desc = 'Вывод абитуриентов, имеющих медаль, их номера паспорта и вида медали.';
	$query1 = 'SELECT enroll_comission."Enrolee"."Name", enroll_comission."Enrolee"."Passport_ID", enroll_comission."Medal"."Type"
	FROM enroll_comission."Enrolee"
	INNER JOIN enroll_comission."Medal" ON enroll_comission."Enrolee"."Medal_ID" = enroll_comission."Medal"."ID"' ;
    
    $query2desc = 'Вывод ФИО абитуриента, его номера сертификата ЕГЭ, даты выдачи сертификата, даты выпуска и времени, прошедшего с выпускного и до получения сертификата';
    $query2 = 'SELECT enroll_comission."Enrolee"."Name", enroll_comission."Enrolee"."EGE_sertificate_ID", enroll_comission."EGE_sertificate"."Issue_date", enroll_comission."School"."Graduation_date", age(enroll_comission."EGE_sertificate"."Issue_date", enroll_comission."School"."Graduation_date")
    FROM enroll_comission."Enrolee"
    INNER JOIN enroll_comission."School" ON enroll_comission."Enrolee"."School_name" = enroll_comission."School"."Name"
    INNER JOIN enroll_comission."EGE_sertificate" ON enroll_comission."Enrolee"."EGE_sertificate_ID" = enroll_comission."EGE_sertificate"."ID"' ;
    
    $query3desc = 'Вывод имен абитуриентов, ФИО которых имеет более 15 символов, номеров их паспортов и длину (посимвольно) номеров';
    $query3 = 'SELECT enroll_comission."Enrolee"."Name", enroll_comission."Passport"."ID" , char_length(enroll_comission."Passport"."ID") as length
	FROM enroll_comission."Passport" 
	INNER JOIN enroll_comission."Enrolee" ON enroll_comission."Enrolee"."Passport_ID" = enroll_comission."Passport"."ID" 
	WHERE length(enroll_comission."Enrolee"."Name") > 15' ;
    
    $query4desc = 'Вывод всей информации о направлении, на котором больше всего свободных мест';
    $query4 = 'SELECT DISTINCT enroll_comission."Course".*
	FROM enroll_comission."Course"
	WHERE NOT enroll_comission."Course"."Available_slots" < SOME (SELECT enroll_comission."Course"."Available_slots" 
	FROM enroll_comission."Course")' ;
    
    $query5desc = 'Вывод имени абитуриента и информации, на бюджете он или нет';
    $query5 = 'SELECT enroll_comission."Enrolee"."Name", enroll_comission."Enrolee"."Budget" as is_smart_enough
	FROM enroll_comission."Enrolee"
	WHERE enroll_comission."Enrolee"."Budget" = true
	UNION
	SELECT enroll_comission."Enrolee"."Name", enroll_comission."Enrolee"."Budget" as is_smart_enough
	FROM enroll_comission."Enrolee"
	WHERE enroll_comission."Enrolee"."Budget" = false
	ORDER BY is_smart_enough' ;

	$res1 = pg_fetch_all(pg_query($db, $query1));
    $res2 = pg_fetch_all(pg_query($db, $query2));
    $res3 = pg_fetch_all(pg_query($db, $query3));
    $res4 = pg_fetch_all(pg_query($db, $query4));
    $res5 = pg_fetch_all(pg_query($db, $query5));

    pg_close($db);
?>

<h2><?php echo $query1desc; ?></h2>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($res1[0])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($res1 as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br>

<h2><?php echo $query2desc; ?></h2>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($res2[0])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($res2 as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br>

<h2><?php echo $query3desc; ?></h2>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($res3[0])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($res3 as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br>

<h2><?php echo $query4desc; ?></h2>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($res4[0])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($res4 as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br>

<h2><?php echo $query5desc; ?></h2>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($res5[0])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($res5 as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br>

<a href = 'index.php'>Домой</a>